<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepository->allProducts();

        return view('master.products.index', [
            'title' => 'Products',
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Product';
        $categories = DB::table('categories')->get();
        $units = DB::table('units')->get();
        $brands = DB::table('brands')->get();

        return view('master.products.create', compact('title','categories','units','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'name' => 'required|string|max:30',
            'initial' => 'required|string|max:10',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'annotation' => 'nullable|string',
            'active' => 'required',
            'category_id' => 'required|integer|exists:categories,id',
            'unit_id' => 'required|integer|exists:units,id',
            'brand_id' => 'required|integer|exists:brands,id',
        ]);

        $this->productRepository->storeProduct($data);

        return redirect()->route('master.products.index')->with('message', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Product';
        $product = $this->productRepository->findProduct($id);

        return view('master.products.index', compact('title','product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Product';
        $product = $this->productRepository->findProduct($id);
        $categories = DB::table('categories')->get();
        $units = DB::table('units')->get();
        $brands = DB::table('brands')->get();

        return view('master.products.edit', compact('title','product','categories','units','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->get('annotation'));
        $request->validate([
            'name' => 'required|string|max:30',
            'initial' => 'required|string|max:10',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'annotation' => 'nullable|string',
            'active' => 'required',
            'category_id' => 'required|integer|exists:categories,id',
            'unit_id' => 'required|integer|exists:units,id',
            'brand_id' => 'required|integer|exists:brands,id',
        ]);

        $this->productRepository->updateProduct($request->all(), $id);

        return redirect()->route('master.products.index')->with('message', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->productRepository->destroyProduct($id);

        return $data;
    }

    /**
     * Retrieving data from resource.
     */
    public function getDataProducts(){

        $data = $this->productRepository->allProducts();

        return $data;
    }
}
