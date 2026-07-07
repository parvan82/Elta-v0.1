<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserLanguageLevel;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // تنظیمات Faker برای داده‌های فارسی
        $faker = Faker::create('fa_IR'); // استفاده از داده‌های فارسی

        // تعریف لیست عناوین شغلی فارسی
        $jobTitles = [
            'برنامه نویس',
            'طراح وب',
            'مدیر پروژه',
            'تحلیلگر داده',
            'مدیر فنی',
            'مهندس نرم‌افزار',
            'مدیر اجرایی',
            'کارشناس سئو',
            'دیزاینر گرافیک',
            'آهنگساز',
        ];

        // تعریف لیست جملات فارسی برای aboutme
        $aboutMeSentences = [
            'من یک فرد سخت‌کوش و با انگیزه هستم که همیشه به دنبال پیشرفت هستم.',
            'به طراحی و برنامه‌نویسی علاقه زیادی دارم و همیشه سعی می‌کنم بهترین نتیجه را بگیرم.',
            'همیشه در تلاش هستم تا بهترین خدمات را به مشتریانم ارائه دهم.',
            'من با تیم‌های مختلف همکاری کرده‌ام و تجربه‌های زیادی در این زمینه دارم.',
            'در زمینه توسعه وب، تجربه و دانش زیادی دارم و به دنبال چالش‌های جدید هستم.',
        ];

        // ساخت 20 کاربر
        foreach (range(1, 20) as $index) {
            // ساخت کاربر
            $user = User::create([
                'name' => $faker->name,
                'username' => $faker->unique()->username,
                'workarea' => $faker->randomElement($jobTitles), // شغل به فارسی
                'aboutme' => $faker->randomElement($aboutMeSentences), // توضیحات درباره خود به فارسی
                'profilepic' => 'images/default.jpg', // تصویر پیش‌فرض پروفایل
                'role' => 'freelancer', // رول فریلنسر
                'password' => bcrypt('password'), // رمز عبور پیش‌فرض
            ]);


            // اضافه کردن زبان‌ها برای کاربر
            $languageCount = rand(1, 3); // تعداد زبان‌های تصادفی (بین 1 تا 3 زبان)
            foreach (range(1, $languageCount) as $languageIndex) {
                UserLanguageLevel::create([
                    'user_id' => $user->id,
                    'language' => $faker->randomElement(['انگلیسی', 'فرانسوی', 'آلمانی', 'اسپانیایی', 'چینی']), // زبان به فارسی
                    'language_level' => $faker->randomElement(['مبتدی', 'متوسط', 'پیشرفته']), // سطح زبان
                ]);
            }
        }
    }
}
