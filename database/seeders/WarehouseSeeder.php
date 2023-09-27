<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warehouse::truncate();

        $json = File::get("database/data/warehouses.json");
        $locations = json_decode($json);

        foreach ($locations as $key => $value) {
            Warehouse::create([
                "name" => $value->name,
                "initial" => $value->initial,
                "address" => $value->address,
                "active" => $value->active,
            ]);
        }
    }
}
