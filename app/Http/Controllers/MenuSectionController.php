<?php

namespace App\Http\Controllers;

use App\Models\MenuSection;
use App\Services\MenuSectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MenuSectionController extends Controller
{
    public function __construct(
        protected MenuSectionService $service
    ) {}

    public function index(Request $request)
    {
        Gate::authorize('viewAny', MenuSection::class);

        $brandId = auth()->user()->brand_id;

        // Debug: Check if brand_id exists
        if (!$brandId) {
            return redirect()->back()->with('error', 'Sizga brand biriktirilmagan! Administrator bilan bog\'laning.');
        }

        $search = $request->input('search');

        $sections = $this->service->getMenuSections($brandId, $search, 15);
        $languages = \App\Models\Language::all();

        return view('pages.menu-sections.index', compact('sections', 'languages'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create', MenuSection::class);

        $validated = $request->validate([
            'translations' => 'required|array',
            'translations.*.name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['brand_id'] = auth()->user()->brand_id;

        try {
            $this->service->createMenuSection($validated);
            return redirect()->route('menu-sections.index')
                ->with('success', 'Раздел меню успешно создан!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Произошла ошибка: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit(MenuSection $menuSection)
    {
        Gate::authorize('update', $menuSection);

        $translations = [];
        foreach ($menuSection->translations as $translation) {
            $translations[$translation->lang_code] = [
                'name' => $translation->name,
            ];
        }

        return response()->json([
            'id' => $menuSection->id,
            'translations' => $translations,
            'sort_order' => $menuSection->sort_order,
        ]);
    }

    public function update(Request $request, MenuSection $menuSection)
    {
        Gate::authorize('update', $menuSection);

        $validated = $request->validate([
            'translations' => 'required|array',
            'translations.*.name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        try {
            $this->service->updateMenuSection($menuSection, $validated);
            return redirect()->route('menu-sections.index')
                ->with('success', 'Раздел меню успешно обновлен!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Произошла ошибка: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(MenuSection $menuSection)
    {
        Gate::authorize('delete', $menuSection);

        try {
            $this->service->deleteMenuSection($menuSection);
            return redirect()->route('menu-sections.index')
                ->with('success', 'Menyu bo\'limi muvaffaqiyatli o\'chirildi!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Xatolik yuz berdi: ' . $e->getMessage());
        }
    }
}
