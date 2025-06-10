<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpensesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('expenses')->insert([
            [
                'category_id' => 1,
                'type_id' => 1,     
                'amount' => 1200.00,
                'date' => '2025-06-01',
                'description' => 'Monthly rent',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2, 
                'type_id' => 1,     
                'amount' => 150.00,
                'date' => '2025-06-02',
                'description' => 'Grocery shopping',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3, 
                'type_id' => 1,     
                'amount' => 50.00,
                'date' => '2025-06-03',
                'description' => 'Bus pass',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'type_id' => 3,   
                'amount' => 100.00,
                'date' => '2025-06-04',
                'description' => 'Concert tickets',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
