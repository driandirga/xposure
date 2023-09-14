<?php

namespace App\Repositories\Interfaces;

interface StockRepositoryInterface
{
    public function allStocks();

    public function storeStock($data);

    public function findStock($id);

    public function updateStock($data, $id);

    public function destroyStock($id);
}
