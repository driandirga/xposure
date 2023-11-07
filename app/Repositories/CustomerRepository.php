<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerRepository implements CustomerRepositoryInterface
{

    public function allCustomers()
    {
        // return Customer::where('active', 1)->paginate(10);
        $customers = DB::table('customers')
            ->select('customers.*', 'salesmen.name as salesman_name')
            ->join('salesmen', 'salesmen.id', '=', 'customers.salesman_id')
            ->where('customers.active', 1)->paginate(10);

        return $customers;
    }

    public function storeCustomer($data)
    {
        return Customer::create($data);
    }

    public function findCustomer($id)
    {
        return Customer::where('id', $id)->firstOrFail();
    }

    public function updateCustomer($data, $id)
    {
        $customer = Customer::where('id', $id)->firstOrFail();
        $customer->name = $data['name'];
        $customer->initial = $data['initial'];
        $customer->phone = $data['phone'];
        $customer->address = $data['address'];
        $customer->salesman_id = $data['salesman_id'];
        $customer->active = $data['active'];
        $customer->save();
    }

    public function destroyCustomer($id)
    {
        $customer = Customer::where('id', $id)->firstOrFail();
        $result = $customer->delete();

        return $result;
    }
}
