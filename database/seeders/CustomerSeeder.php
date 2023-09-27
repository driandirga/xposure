<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::truncate();

        $json = File::get("database/data/customers.json");
        $locations = json_decode($json);

        foreach ($locations as $key => $value) {
            Customer::create([
                "name" => $value->name,
                "initial" => $value->initial,
                "address" => $value->address,
                "phone" => $value->phone,
                "active" => $value->active,
                "salesman_id" => $value->salesman_id,
            ]);
        }
    }
}
