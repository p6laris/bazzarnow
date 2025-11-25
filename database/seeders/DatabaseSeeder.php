<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::factory()->count(60)->create();

        User::factory()->create([
            'name' => 'Sonya Burhan',
            'email' => 'sonyaburhan@bazzarnow.com',
            'password' => Hash::make('Sonya1234'),
            'is_admin' => true,
        ]);    }
}
