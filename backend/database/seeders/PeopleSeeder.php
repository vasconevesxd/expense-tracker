<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('people')->insert([
            ['name' => 'John Doe', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jane Smith', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alice Johnson', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bob Wilson', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
