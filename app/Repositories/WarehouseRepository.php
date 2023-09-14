<?php

namespace App\Repositories;

use App\Repositories\Interfaces\WarehouseRepositoryInterface;
use App\Models\Warehouse;

class WarehouseRepository implements WarehouseRepositoryInterface
{

    public function allWarehouses()
    {
        return Warehouse::where('active', 1)->paginate(10);
    }

    public function storeWarehouse($data)
    {
        return Warehouse::create($data);
    }

    public function findWarehouse($id)
    {
        return Warehouse::where('id', $id)->firstOrFail();
    }

    public function updateWarehouse($data, $id)
    {
        $warehouse = Warehouse::where('id', $id)->firstOrFail();
        $warehouse->name = $data['name'];
        $warehouse->initial = $data['initial'];
        $warehouse->address = $data['address'];
        $warehouse->active = $data['active'];
        $warehouse->save();
    }

    public function destroyWarehouse($id)
    {
        $warehouse = Warehouse::where('id', $id)->firstOrFail();
        $result = $warehouse->delete();

        return $result;
    }
}
