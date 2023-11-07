<?php

namespace App\Repositories;

use App\Repositories\Interfaces\StockRepositoryInterface;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class StockRepository implements StockRepositoryInterface
{

    public function allStocks()
    {
         // return Stock::where('active', 1)->paginate(10);
         $stocks = DB::table('stocks')
         ->select(DB::raw('SUM(stocks.debit-stocks.credit) as total_stock'), 'stocks.debit', 'stocks.credit', 'warehouses.name as warehouse_name', 'products.name as product_name')
         ->join('warehouses', 'warehouses.id', '=', 'stocks.warehouse_id')
         ->join('products', 'products.id', '=', 'stocks.product_id')
         ->groupBy('stocks.id', 'stocks.debit', 'stocks.credit', 'warehouses.name', 'products.name')->paginate(10);

     return $stocks;
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
        $stock->debit = $data['debit'];
        $stock->credit = $data['credit'];
        $stock->warehouse_id = $data['warehouse_id'];
        $stock->product_id = $data['product_id'];
        $stock->save();
    }

    public function destroyStock($id)
    {
        $stock = Stock::where('id', $id)->firstOrFail();
        $result = $stock->delete();

        return $result;
    }
}
