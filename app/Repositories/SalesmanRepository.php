<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SalesmanRepositoryInterface;
use App\Models\Salesman;

class SalesmanRepository implements SalesmanRepositoryInterface
{

    public function allSalesmen()
    {
        return Salesman::where('active', 1)->paginate(10);
    }

    public function storeSalesman($data)
    {
        return Salesman::create($data);
    }

    public function findSalesman($id)
    {
        return Salesman::where('id', $id)->firstOrFail();
    }

    public function updateSalesman($data, $id)
    {
        $salesman = Salesman::where('id', $id)->firstOrFail();
        $salesman->name = $data['name'];
        $salesman->initial = $data['initial'];
        $salesman->phone = $data['phone'];
        $salesman->address = $data['address'];
        $salesman->active = $data['active'];
        $salesman->save();
    }

    public function destroySalesman($id)
    {
        $salesman = Salesman::where('id', $id)->firstOrFail();
        $result = $salesman->delete();

        return $result;
    }
}
