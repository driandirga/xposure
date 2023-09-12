<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::truncate();
  
        $json = File::get("database/data/brands.json");
        $locations = json_decode($json);
  
        foreach ($locations as $key => $value) {
            Brand::create([
                "name" => $value->name,
                "initial" => $value->initial,
                "active" => $value->active,
            ]);
        }
    }
}
