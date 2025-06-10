<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('expense_types')->insert([
            ['name' => 'Essential', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Well-being', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Luxury', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
