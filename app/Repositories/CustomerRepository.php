<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{

    public function allCustomers()
    {
        return Customer::where('active', 1)->paginate(10);
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
