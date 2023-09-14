<?php

namespace App\Repositories;

use App\Repositories\Interfaces\StockRepositoryInterface;
use App\Models\Stock;

class StockRepository implements StockRepositoryInterface
{

    public function allStocks()
    {
        return Stock::where('active', 1)->paginate(10);
    }

    public function storeStock($data)
    {
        return Stock::create($data);
    }

    public function findStock($id)
    {
        return Stock::where('id', $id)->firstOrFail();
    }

    public function updateStock($data, $id)
    {
        $stock = Stock::where('id', $id)->firstOrFail();
        $stock->warehouse_id = $data['warehouse_id'];
        $stock->product_id = $data['product_id'];
        $stock->debit = $data['debit'];
        $stock->credit = $data['credit'];
        $stock->save();
    }

    public function destroyStock($id)
    {
        $stock = Stock::where('id', $id)->firstOrFail();
        $result = $stock->delete();

        return $result;
    }
}
