<?php

namespace Database\Seeders;

use App\Models\Salesman;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SalesmanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Salesman::truncate();

        $json = File::get("database/data/salesmen.json");
        $locations = json_decode($json);

        foreach ($locations as $key => $value) {
            Salesman::create([
                "name" => $value->name,
                "initial" => $value->initial,
                "address" => $value->address,
                "phone" => $value->phone,
                "active" => $value->active,
            ]);
        }
    }
}
