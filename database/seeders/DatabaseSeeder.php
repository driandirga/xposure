<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();
        \App\Models\User::factory()->create([
            'username' => 'driandirga',
            'email' => 'driandirga@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('rahasia123'),
            'remember_token' => Str::random(10),
        ]);

        $this->call(BrandSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(UnitSeeder::class);
    }
}
