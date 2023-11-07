<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stock::truncate();

        $json = File::get("database/data/stocks.json");
        $locations = json_decode($json);

        foreach ($locations as $key => $value) {
            Stock::create([
                "debit" => $value->debit,
                "credit" => $value->credit,
                "warehouse_id" => $value->warehouse_id,
                "product_id" => $value->product_id,
            ]);
        }
    }
}
