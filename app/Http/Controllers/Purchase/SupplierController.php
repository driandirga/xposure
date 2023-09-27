<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\SupplierRepositoryInterface;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    private SupplierRepositoryInterface $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = $this->supplierRepository->allSuppliers();

        return view('purchase.suppliers.index', [
            'title' => 'Suppliers',
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Supplier';

        return view('purchase.suppliers.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:30',
            'initial' => 'required|string|max:10',
            'address' => 'required|string',
            'phone' => 'required|string',
            'active' => 'required',
        ]);

        $this->supplierRepository->storeSupplier($data);

        return redirect()->route('suppliers.index')->with('message', 'Supplier Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Supplier';
        $supplier = $this->supplierRepository->findSupplier($id);

        return view('purchase.suppliers.index', compact('title','supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Supplier';
        $supplier = $this->supplierRepository->findSupplier($id);

        return view('purchase.suppliers.edit', compact('title','supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'initial' => 'required|string|max:10',
            'address' => 'required|string',
            'phone' => 'required|string',
            'active' => 'required',
        ]);

        $this->supplierRepository->updateSupplier($request->all(), $id);

        return redirect()->route('suppliers.index')->with('message', 'Supplier Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->supplierRepository->destroySupplier($id);

        return $data;
    }

    /**
     * Retrieving data from resource.
     */
    public function getDataSuppliers(){

        $data = $this->supplierRepository->allSuppliers();

        return $data;
    }
}
