<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SupplierRepositoryInterface;
use App\Models\Supplier;

class SupplierRepository implements SupplierRepositoryInterface
{

    public function allSuppliers()
    {
        return Supplier::where('active', 1)->paginate(10);
    }

    public function storeSupplier($data)
    {
        return Supplier::create($data);
    }

    public function findSupplier($id)
    {
        return Supplier::where('id', $id)->firstOrFail();
    }

    public function updateSupplier($data, $id)
    {
        $supplier = Supplier::where('id', $id)->firstOrFail();
        $supplier->name = $data['name'];
        $supplier->initial = $data['initial'];
        $supplier->phone = $data['phone'];
        $supplier->address = $data['address'];
        $supplier->active = $data['active'];
        $supplier->save();
    }

    public function destroySupplier($id)
    {
        $supplier = Supplier::where('id', $id)->firstOrFail();
        $result = $supplier->delete();

        return $result;
    }
}
