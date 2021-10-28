<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getCategories();
        return view('categories/index', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->categoryRepository->createCategory($request->validated());
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
       $category= $this->categoryRepository->findCategory($id);
        return view('categories/edit', compact('category'));
    }

    public function update(StoreCategoryRequest $request, $id)
    {
        $this->categoryRepository->updateCategory($id,$request->validated());
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $this->categoryRepository->deleteCategory($id);
        return redirect()->route('categories.index');
    }
}
