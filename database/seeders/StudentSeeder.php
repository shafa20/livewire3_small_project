<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->truncate();
        for ($i = 1; $i <= 10000; $i++) {
            DB::table('students')->insert([
                'roll' => $i,
                'name' => 'Student ' . $i,
                'registration' => 'REG-' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
