<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService,
        protected CategoryRepository $categoryRepository
    ) {}

    public function index(Request $request)
    {
        $search = $request->get('search');
        $categories = $this->categoryService->getCategories($search);

        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            $data = $request->validated();
            $data['translations'] = $this->categoryService->prepareTranslations($data);

            $this->categoryService->createCategory($data);

            return redirect()->route('categories.index')->with('success', 'Категория успешно создана');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Ошибка при создании категории: ' . $e->getMessage());
        }
    }

    public function edit(Category $category)
    {
        $category->load('translations');

        return response()->json([
            'id'           => $category->id,
            'icon'         => $category->icon,
            'translations' => $category->translations->mapWithKeys(function($translation) {
                return [$translation->lang_code => [
                    'name' => $translation->name,
                    'description' => $translation->description,
                ]];
            })->toArray(),
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $data = $request->validated();
            $data['translations'] = $this->categoryService->prepareTranslations($data);

            $this->categoryService->updateCategory($category, $data);

            return redirect()->route('categories.index')
                ->with('success', 'Категория успешно обновлена');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Ошибка при обновлении категории: ' . $e->getMessage());
        }
    }

    public function destroy(Category $category)
    {
        try {
            $this->categoryService->deleteCategory($category);

            return redirect()->route('categories.index')
                ->with('success', 'Категория успешно удалена');
        } catch (\Exception $e) {
            return back()->with('error', 'Ошибка при удалении категории: ' . $e->getMessage());
        }
    }
}
