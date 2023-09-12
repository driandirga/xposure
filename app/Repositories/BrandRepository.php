<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Models\Brand;

class BrandRepository implements BrandRepositoryInterface
{

    public function allBrands()
    {
        return Brand::where('active', 1)->paginate(10);
    }

    public function storeBrand($data)
    {
        return Brand::create($data);
    }

    public function findBrand($id)
    {
        return Brand::where('id', $id)->firstOrFail();
    }

    public function updateBrand($data, $id)
    {
        $brand = Brand::where('id', $id)->firstOrFail();
        $brand->name = $data['name'];
        $brand->initial = $data['initial'];
        $brand->active = $data['active'];
        $brand->save();
    }

    public function destroyBrand($id)
    {
        $brand = Brand::where('id', $id)->firstOrFail();
        $result = $brand->delete();

        return $result;
    }
}
