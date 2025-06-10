<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('income_types')->insert([
            ['name' => 'Salary', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Extra', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
