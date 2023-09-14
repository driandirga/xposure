<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\SalesmanRepositoryInterface;
use Illuminate\Http\Request;

class SalesmanController extends Controller
{
    private SalesmanRepositoryInterface $salesmanRepository;

    public function __construct(SalesmanRepositoryInterface $salesmanRepository)
    {
        $this->salesmanRepository = $salesmanRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesmen = $this->salesmanRepository->allSalesmen();

        return view('master.salesmen.index', [
            'title' => 'Salesmen',
            'salesmen' => $salesmen
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Salesman';

        return view('master.salesmen.create', compact('title'));
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

        $this->salesmanRepository->storeSalesman($data);

        return redirect()->route('salesmen.index')->with('message', 'Salesman Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Salesman';
        $salesman = $this->salesmanRepository->findSalesman($id);

        return view('master.salesmen.index', compact('title','salesman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Salesman';
        $salesman = $this->salesmanRepository->findSalesman($id);

        return view('master.salesmen.edit', compact('title','salesman'));
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

        $this->salesmanRepository->updateSalesman($request->all(), $id);

        return redirect()->route('salesmen.index')->with('message', 'Salesman Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->salesmanRepository->destroySalesman($id);

        return $data;
    }

    /**
     * Retrieving data from resource.
     */
    public function getDataSalesmen(){

        $data = $this->salesmanRepository->allSalesmen();

        return $data;
    }
}
