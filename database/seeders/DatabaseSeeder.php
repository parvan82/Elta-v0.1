<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
public function run(): void
{
    $this->call([
        skillSeeder::class,          // اول Skills رو بساز
        UsersSeeder::class,          // بعد Users
        employerSeeder::class,       // کارفرماها
        NewProjectSeeder::class,     // پروژه‌ها که به Skills و Users وابسته هست
        AdvatisementSeeder::class,   // آگهی‌ها که به Users و Skills وابسته
        KeywordSeeder::class,
        KeywordMappingSeeder::class,
        skillMappingSeeder::class,
    ]);
}

}
