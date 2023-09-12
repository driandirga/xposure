<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function allCategories()
    {
        return Category::where('active', 1)->paginate(10);
    }

    public function storeCategory($data)
    {
        return Category::create($data);
    }

    public function findCategory($id)
    {
        return Category::where('id', $id)->firstOrFail();
    }

    public function updateCategory($data, $id)
    {
        $category = Category::where('id', $id)->firstOrFail();
        $category->name = $data['name'];
        $category->initial = $data['initial'];
        $category->active = $data['active'];
        $category->save();
    }

    public function destroyCategory($id)
    {
        $category = Category::where('id', $id)->firstOrFail();
        $result = $category->delete();

        return $result;
    }
}
