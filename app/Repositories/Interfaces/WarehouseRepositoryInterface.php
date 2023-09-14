<?php

namespace App\Repositories\Interfaces;

interface WarehouseRepositoryInterface
{
    public function allWarehouses();

    public function storeWarehouse($data);

    public function findWarehouse($id);

    public function updateWarehouse($data, $id);

    public function destroyWarehouse($id);
}
