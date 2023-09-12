<?php

namespace App\Repositories\Interfaces;

interface BrandRepositoryInterface
{
    public function allBrands();

    public function storeBrand($data);

    public function findBrand($id);

    public function updateBrand($data, $id);

    public function destroyBrand($id);
}
