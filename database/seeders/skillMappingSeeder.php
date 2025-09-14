<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class skillMappingSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('fa_IR');

        // گرفتن آیدی همه کاربران
        $userIds = DB::table('users')->pluck('id')->toArray();

        // گرفتن آیدی همه مهارت‌ها
        $skillIds = DB::table('user_skill')->pluck('id')->toArray();

        foreach ($userIds as $userId) {
            // انتخاب تصادفی 1 تا 5 مهارت
            $randomSkillIds = $faker->randomElements($skillIds, rand(1, min(5, count($skillIds))));

            foreach ($randomSkillIds as $skillId) {
                DB::table('skill_mapping')->insert([
                    'user_id' => $userId,
                    'skill_id' => $skillId,
                    'level' => $faker->randomElement(['مبتدی', 'متوسط', 'پیشرفته']),
                ]);
            }
        }
    }
}
