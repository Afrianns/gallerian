<?php

namespace Database\Seeders;

use App\Models\useradmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // useradmin::create()

        // DB::table('useradmins')->insert([
        //     "name" => "jack",
        //     "password" => Hash::make("qwerty"),
        // ]);
    }
}
