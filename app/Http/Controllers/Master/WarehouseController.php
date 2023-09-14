<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\WarehouseRepositoryInterface;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    private WarehouseRepositoryInterface $warehouseRepository;

    public function __construct(WarehouseRepositoryInterface $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = $this->warehouseRepository->allWarehouses();

        return view('master.warehouses.index', [
            'title' => 'Warehouses',
            'warehouses' => $warehouses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Warehouse';

        return view('master.warehouse.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:30',
            'initial' => 'required|string|max:5',
            'address' => 'required|string',
            'active' => 'required',
        ]);

        $this->warehouseRepository->storeWarehouse($data);

        return redirect()->route('warehouses.index')->with('message', 'Warehouse Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Warehouse';
        $warehouse = $this->warehouseRepository->findWarehouse($id);

        return view('master.warehouses.index', compact('title','warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Warehouse';
        $warehouse = $this->warehouseRepository->findWarehouse($id);

        return view('master.warehouses.edit', compact('title','warehouse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'initial' => 'required|string|max:5',
            'address' => 'required|string',
            'active' => 'required',
        ]);

        $this->warehouseRepository->updateWarehouse($request->all(), $id);

        return redirect()->route('warehouses.index')->with('message', 'Warehouse Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->warehouseRepository->destroyWarehouse($id);

        return $data;
    }

    /**
     * Retrieving data from resource.
     */
    public function getDataWarehouses(){

        $data = $this->warehouseRepository->allWarehouses();

        return $data;
    }
}
