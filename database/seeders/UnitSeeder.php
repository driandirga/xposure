<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::truncate();
  
        $json = File::get("database/data/units.json");
        $locations = json_decode($json);
  
        foreach ($locations as $key => $value) {
            Unit::create([
                "name" => $value->name,
                "initial" => $value->initial,
                "active" => $value->active,
            ]);
        }
    }
}
