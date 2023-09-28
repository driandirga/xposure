<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        $json = File::get("database/data/products.json");
        $locations = json_decode($json);
        
        foreach ($locations as $key => $value) {
            Product::create([
                "name" => $value->name,
                "initial" => $value->initial,
                "purchase_price" => $value->purchase_price,
                "selling_price" => $value->selling_price,
                "annotation" => $value->annotation,
                "active" => $value->active,
                "category_id" => $value->category_id,
                "unit_id" => $value->unit_id,
                "brand_id" => $value->brand_id,
            ]);
        }
    }
}
