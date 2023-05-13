<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\V1\TagSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $seeders = [
            TagSeeder::class,
            CategorySeeder::class
        ];

        $testingSeeders = [

        ];

        if (app()->environment('testing')) {
            $seeders = array_merge($seeders, $testingSeeders);
        }

        $this->call($seeders);
    }
}
