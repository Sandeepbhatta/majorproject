<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Nadmin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Admin::factory(2)->create();

        \App\Models\Nadmin::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@gmail.com',
            'password' =>Hash::make('password'),
            'status' => true,
        ]);
    }
}
