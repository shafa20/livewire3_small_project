<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        DB::table('students')->truncate();
        for ($i = 1; $i <= 10000; $i++) {
            DB::table('students')->insert([
                'roll' => $i,
                'name' => $faker->name,
                'registration' => 'REG-' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
