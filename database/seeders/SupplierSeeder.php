<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::truncate();

        $json = File::get("database/data/suppliers.json");
        $locations = json_decode($json);

        foreach ($locations as $key => $value) {
            Supplier::create([
                "name" => $value->name,
                "initial" => $value->initial,
                "address" => $value->address,
                "phone" => $value->phone,
                "active" => $value->active,
            ]);
        }
    }
}
