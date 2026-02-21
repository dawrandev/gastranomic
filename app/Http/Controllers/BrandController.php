<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(
        protected BrandService $brandService,
    ) {}

    public function index(Request $request)
    {
        $search = $request->get('search');
        $brands = $this->brandService->getBrands($search);

        return view('pages.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('pages.brands.create');
    }

    public function store(StoreBrandRequest $request)
    {
        try {
            $data = $request->validated();
            $data['translations'] = $this->brandService->prepareTranslations($data);

            $this->brandService->createBrand($data);

            return redirect()->route('brands.index')->with('success', 'Бренд успешно создан');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Ошибка при создании бренда: ' . $e->getMessage());
        }
    }

    public function edit(Brand $brand)
    {
        $brand = $this->brandService->findBrand($brand->id);

        return response()->json([
            'id' => $brand->id,
            'logo' => $brand->logo,
            'translations' => $brand->translations->mapWithKeys(function($translation) {
                return [$translation->lang_code => [
                    'name' => $translation->name,
                    'description' => $translation->description,
                ]];
            })->toArray(),
        ]);
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        try {
            $data = $request->validated();
            $data['translations'] = $this->brandService->prepareTranslations($data);

            $this->brandService->updateBrand($brand, $data);

            return redirect()->route('brands.index')->with('success', 'Бренд успешно обновлен');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Ошибка при обновлении бренда: ' . $e->getMessage());
        }
    }

    public function destroy(Brand $brand)
    {
        try {
            if ($brand->restaurants()->count() > 0) {
                return back()->with('error', 'Невозможно удалить бренд. У него есть рестораны.');
            }

            if ($brand->users()->count() > 0) {
                return back()->with('error', 'Невозможно удалить бренд. У него есть пользователи.');
            }

            $this->brandService->deleteBrand($brand);

            return redirect()->route('brands.index')->with('success', 'Бренд успешно удален');
        } catch (\Exception $e) {
            return back()->with('error', 'Ошибка при удалении бренда: ' . $e->getMessage());
        }
    }
}
