<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{

    public function allProducts()
    {
        // return Product::where('active', 1)->paginate(10);
        $products = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('units', 'units.id', '=', 'products.unit_id')
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->select('products.*', 'categories.name as category_name', 'units.name as unit_name', 'brands.name as brand_name')
            ->where('products.active', 1)->paginate(10);

        return $products;
    }

    public function storeProduct($data)
    {
        return Product::create($data);
    }

    public function findProduct($id)
    {
        return Product::where('id', $id)->firstOrFail();
    }

    public function updateProduct($data, $id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        $product->name = $data['name'];
        $product->initial = $data['initial'];
        $product->category_id = $data['category_id'];
        $product->unit_id = $data['unit_id'];
        $product->brand_id = $data['brand_id'];
        $product->purchase_price = $data['purchase_price'];
        $product->selling_price = $data['selling_price'];
        $product->annotation = $data['annotation'];
        $product->active = $data['active'];
        $product->save();
    }

    public function destroyProduct($id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        $result = $product->delete();

        return $result;
    }
}
