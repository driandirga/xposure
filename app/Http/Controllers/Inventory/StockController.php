<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\StockRepositoryInterface;
use Illuminate\Http\Request;

class StockController extends Controller
{
    private StockRepositoryInterface $stockRepository;

    public function __construct(StockRepositoryInterface $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = $this->stockRepository->allStocks();

        return view('master.stocks.index', [
            'title' => 'Stocks',
            'stocks' => $stocks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Stock';

        return view('master.stocks.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'debit' => 'required|double',
            'credit' => 'required|double',
            'warehouse_id' => 'required|integer|exists:warehouses,id',
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $this->stockRepository->storeStock($data);

        return redirect()->route('stocks.index')->with('message', 'Stock Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Stock';
        $stock = $this->stockRepository->findStock($id);

        return view('master.stocks.index', compact('title','stock'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Stock';
        $stock = $this->stockRepository->findStock($id);

        return view('master.stocks.edit', compact('title','stock'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'debit' => 'required|double',
            'credit' => 'required|double',
            'warehouse_id' => 'required|integer|exists:warehouses,id',
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $this->stockRepository->updateStock($request->all(), $id);

        return redirect()->route('stocks.index')->with('message', 'Stock Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->stockRepository->destroyStock($id);

        return $data;
    }

    /**
     * Retrieving data from resource.
     */
    public function getDataStocks(){

        $data = $this->stockRepository->allStocks();

        return $data;
    }
}
