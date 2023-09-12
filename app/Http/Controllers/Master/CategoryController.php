<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryRepository->allCategories();

        return view('master.categories.index', [
            'title' => 'Categories',
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Category';

        return view('master.categories.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:10',
            'initial' => 'required|string|max:3',
            'active' => 'required',
        ]);

        $this->categoryRepository->storecategory($data);

        return redirect()->route('categories.index')->with('message', 'category Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Category';
        $category = $this->categoryRepository->findCategory($id);

        return view('master.categories.index', compact('title','Category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Category';
        $category = $this->categoryRepository->findCategory($id);

        return view('master.categories.edit', compact('title','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:10',
            'initial' => 'required|string|max:3',
            'active' => 'required',
        ]);

        $this->categoryRepository->updateCategory($request->all(), $id);

        return redirect()->route('categories.index')->with('message', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->categoryRepository->destroyCategory($id);

        return $data;
    }

    /**
     * Retrieving data from resource.
     */
    public function getDataCategories(){

        $data = $this->categoryRepository->allCategories();

        return $data;
    }
}
