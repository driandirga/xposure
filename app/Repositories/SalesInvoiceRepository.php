<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UnitRepositoryInterface;
use App\Models\Unit;

class UnitRepository implements UnitRepositoryInterface
{

    public function allUnits()
    {
        return Unit::where('active', 1)->paginate(10);
    }

    public function storeUnit($data)
    {
        return Unit::create($data);
    }

    public function findUnit($id)
    {
        return Unit::where('id', $id)->firstOrFail();
    }

    public function updateUnit($data, $id)
    {
        $unit = Unit::where('id', $id)->firstOrFail();
        $unit->name = $data['name'];
        $unit->initial = $data['initial'];
        $unit->active = $data['active'];
        $unit->save();
    }

    public function destroyUnit($id)
    {
        $unit = Unit::where('id', $id)->firstOrFail();
        $result = $unit->delete();

        return $result;
    }
}
