<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    private BrandRepositoryInterface $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = $this->brandRepository->allBrands();

        return view('master.brands.index', [
            'title' => 'Brands',
            'brands' => $brands
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Brand';

        return view('master.brands.create', compact('title'));
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

        $this->brandRepository->storeBrand($data);

        return redirect()->route('brands.index')->with('message', 'Brand Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Brand';
        $brand = $this->brandRepository->findBrand($id);

        return view('master.brands.index', compact('title','brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Brand';
        $brand = $this->brandRepository->findBrand($id);

        return view('master.brands.edit', compact('title','brand'));
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

        $this->brandRepository->updateBrand($request->all(), $id);

        return redirect()->route('brands.index')->with('message', 'Brand Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->brandRepository->destroyBrand($id);

        return $data;
    }

    /**
     * Retrieving data from resource.
     */
    public function getDataBrands(){

        $data = $this->brandRepository->allBrands();

        return $data;
    }
}
