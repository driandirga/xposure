<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private CustomerRepositoryInterface $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = $this->customerRepository->allCustomers();

        return view('master.customers.index', [
            'title' => 'Customers',
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Customer';

        return view('master.customers.create', compact('title'));
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
            'salesman_id' => 'required|integer|exists:salesmen,id',
        ]);

        $this->customerRepository->storeCustomer($data);

        return redirect()->route('customers.index')->with('message', 'Customer Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Customer';
        $customer = $this->customerRepository->findCustomer($id);

        return view('master.customers.index', compact('title','customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Customer';
        $customer = $this->customerRepository->findCustomer($id);

        return view('master.customers.edit', compact('title','customer'));
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
            'salesman_id' => 'required|integer|exists:salesmen,id',
        ]);

        $this->customerRepository->updateCustomer($request->all(), $id);

        return redirect()->route('customers.index')->with('message', 'Customer Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->customerRepository->destroyCustomer($id);

        return $data;
    }

    /**
     * Retrieving data from resource.
     */
    public function getDataCustomers(){

        $data = $this->customerRepository->allCustomers();

        return $data;
    }
}
