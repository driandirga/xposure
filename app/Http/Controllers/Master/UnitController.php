<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UnitRepositoryInterface;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    private UnitRepositoryInterface $unitRepository;

    public function __construct(UnitRepositoryInterface $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = $this->unitRepository->allUnits();

        return view('master.units.index', [
            'title' => 'Units',
            'units' => $units
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Unit';

        return view('master.units.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:10',
            'initial' => 'required|string|max:3',
            'active' => 'required',
        ]);

        $this->unitRepository->storeUnit($data);

        return redirect()->route('units.index')->with('message', 'Unit Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Unit';
        $unit = $this->unitRepository->findUnit($id);

        return view('master.units.index', compact('title','unit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Unit';
        $unit = $this->unitRepository->findUnit($id);

        return view('master.units.edit', compact('title','unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:10',
            'initial' => 'required|string|max:3',
            'active' => 'required',
        ]);

        $this->unitRepository->updateUnit($request->all(), $id);

        return redirect()->route('units.index')->with('message', 'Unit Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->unitRepository->destroyUnit($id);

        return $data;
    }

    /**
     * Retrieving data from resource.
     */
    public function getDataUnits(){

        $data = $this->unitRepository->allUnits();

        return $data;
    }
}
