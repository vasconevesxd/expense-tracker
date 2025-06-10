<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('income')->insert([
            [
                'person_id' => 1, 
                'type_id' => 1,   
                'amount' => 5000.00,
                'description' => 'Monthly salary',
                'date' => '2025-06-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 2, 
                'type_id' => 2,   
                'amount' => 200.00,
                'description' => 'Freelance work',
                'date' => '2025-06-03',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 3, 
                'type_id' => 1,  
                'amount' => 4500.00,
                'description' => 'Monthly salary',
                'date' => '2025-06-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
