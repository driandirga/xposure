<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        $json = File::get("database/data/categories.json");
        $locations = json_decode($json);

        foreach ($locations as $key => $value) {
            Category::create([
                "name" => $value->name,
                "initial" => $value->initial,
                "active" => $value->active,
            ]);
        }
    }
}