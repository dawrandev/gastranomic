<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\QuestionCategory;
use App\Models\QuestionOption;
use App\Models\Language;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $questions = QuestionCategory::with([
                'translations',
                'options.translations',
                'children.translations',
                'children.options.translations'
            ])
            ->whereNull('parent_category_id') // Only load parent categories
            ->when($search, function ($query) use ($search) {
                $query->whereHas('translations', function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%");
                });
            })
            ->orderBy('sort_order')
            ->paginate(15);

        return view('pages.questions.index', compact('questions'));
    }

    public function create()
    {
        $languages = Language::all();
        return view('pages.questions.create', compact('languages'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'key' => 'required|string|unique:questions_categories,key',
                'sort_order' => 'required|integer|min:0',
                'is_required' => 'boolean',
                'is_active' => 'boolean',
                'translations' => 'required|array',
                'translations.*.lang_code' => 'required|string',
                'translations.*.title' => 'required|string|max:255',
                'translations.*.description' => 'nullable|string|max:1000',
            ]);

            $category = QuestionCategory::create([
                'key' => $validated['key'],
                'sort_order' => $validated['sort_order'],
                'is_required' => $request->has('is_required'),
                'is_active' => $request->has('is_active') ?? true,
            ]);

            foreach ($validated['translations'] as $translation) {
                $category->translations()->create($translation);
            }

            return redirect()->route('questions.index')
                ->with('success', 'Категория вопросов успешно создана');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Ошибка при создании: ' . $e->getMessage());
        }
    }

    public function edit(QuestionCategory $question)
    {
        $question->load('translations', 'options.translations');
        $languages = Language::all();

        return view('pages.questions.edit', compact('question', 'languages'));
    }

    public function update(Request $request, QuestionCategory $question)
    {
        try {
            $validated = $request->validate([
                'key' => 'required|string|unique:questions_categories,key,' . $question->id,
                'sort_order' => 'required|integer|min:0',
                'is_required' => 'boolean',
                'is_active' => 'boolean',
                'translations' => 'required|array',
                'translations.*.lang_code' => 'required|string',
                'translations.*.title' => 'required|string|max:255',
                'translations.*.description' => 'nullable|string|max:1000',
            ]);

            $question->update([
                'key' => $validated['key'],
                'sort_order' => $validated['sort_order'],
                'is_required' => $request->has('is_required'),
                'is_active' => $request->has('is_active'),
            ]);

            // Update translations
            $question->translations()->delete();
            foreach ($validated['translations'] as $translation) {
                $question->translations()->create($translation);
            }

            return redirect()->route('questions.index')
                ->with('success', 'Категория вопросов успешно обновлена');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Ошибка при обновлении: ' . $e->getMessage());
        }
    }

    public function destroy(QuestionCategory $question)
    {
        try {
            $question->delete();
            return redirect()->route('questions.index')
                ->with('success', 'Категория вопросов успешно удалена');
        } catch (\Exception $e) {
            return back()->with('error', 'Ошибка при удалении: ' . $e->getMessage());
        }
    }

    public function setLocale(string $locale)
    {
        $validLocales = ['uz', 'ru', 'kk', 'en'];

        if (in_array($locale, $validLocales)) {
            session(['locale' => $locale]);
            app()->setLocale($locale);
        }

        return redirect()->route('questions.index');
    }
}
