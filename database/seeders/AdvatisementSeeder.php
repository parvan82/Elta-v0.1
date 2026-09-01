<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Advatisement;
use App\Models\AdImage;
use App\Models\ServicesTag;
use Carbon\Carbon;

class AdvatisementSeeder extends Seeder
{
    public function run(): void
    {
        // سرویس‌ها + تایتل + کپشن واقعی
        $services = [
            'برنامه نویسی' => [
                'titles' => [
                    'طراحی و توسعه وب‌سایت اختصاصی با لاراول',
                    'پیاده‌سازی API و بک‌اند حرفه‌ای',
                    'برنامه‌نویسی سیستم‌های تحت وب مقیاس‌پذیر',
                ],
                'descriptions' => [
                    'طراحی و پیاده‌سازی وب‌سایت کاملاً اختصاصی با استفاده از Laravel و معماری تمیز. رعایت اصول امنیت، سرعت و توسعه‌پذیری در اولویت کار من است.',
                    'اگر به دنبال یک بک‌اند قوی و امن هستید، من می‌توانم APIهای استاندارد و قابل توسعه برای پروژه شما طراحی و پیاده‌سازی کنم.',
                ],
            ],

            'طراحی گرافیک' => [
                'titles' => [
                    'طراحی لوگو حرفه‌ای متناسب با برند شما',
                    'طراحی هویت بصری و گرافیک تبلیغاتی',
                ],
                'descriptions' => [
                    'طراحی لوگو و المان‌های گرافیکی با در نظر گرفتن هویت برند، بازار هدف و استانداردهای طراحی روز.',
                    'طراحی پوستر، بنر و محتوای گرافیکی برای شبکه‌های اجتماعی با خروجی باکیفیت و قابل چاپ.',
                ],
            ],

            'تولید محتوا' => [
                'titles' => [
                    'تولید محتوای تخصصی برای سایت و شبکه‌های اجتماعی',
                    'نویسندگی سئو شده برای افزایش بازدید سایت',
                ],
                'descriptions' => [
                    'تولید محتوای یونیک و سئو شده متناسب با حوزه کاری شما برای افزایش تعامل و جذب مخاطب.',
                    'اگر به محتوای حرفه‌ای، ساختارمند و مطابق اصول SEO نیاز دارید، این سرویس مناسب شماست.',
                ],
            ],

            'دیتابیس' => [
                'titles' => [
                    'طراحی و بهینه‌سازی دیتابیس‌های MySQL و PostgreSQL',
                    'بهینه‌سازی کوئری‌ها و ساختار دیتابیس',
                ],
                'descriptions' => [
                    'طراحی دیتابیس استاندارد و بهینه برای پروژه‌های کوچک و بزرگ با تمرکز بر سرعت و امنیت.',
                    'بررسی و بهینه‌سازی کوئری‌ها برای افزایش Performance سیستم.',
                ],
            ],

            'CRM' => [
                'titles' => [
                    'پیاده‌سازی سیستم CRM اختصاصی',
                    'طراحی و توسعه نرم‌افزار مدیریت مشتریان',
                ],
                'descriptions' => [
                    'پیاده‌سازی CRM متناسب با فرآیندهای کسب‌وکار شما جهت افزایش فروش و مدیریت بهتر مشتریان.',
                ],
            ],
        ];

        // تصاویر رندوم
        $imagesPool = [
            'images/adsImage/1.jpg',
            'images/adsImage/2.jpg',
            'images/adsImage/3.jpg',
            'images/adsImage/4.jpg',
            'images/adsImage/5.jpg',
            'images/adsImage/6.jpg',
            'images/adsImage/7.jpg',
            'images/adsImage/8.jpg',
            'images/adsImage/9.jpg',
            'images/adsImage/10.jpg',
            'images/adsImage/11.jpg',
            'images/adsImage/12.jpg',
            'images/adsImage/13.jpg',
        ];

        // کاربرانی که پروژه ندارند
        $users = User::where('role', 'freelancer')
            ->whereDoesntHave('ads')
            ->get();

        if ($users->isEmpty()) {
            $this->command->warn('هیچ فریلنسر بدون پروژه پیدا نشد');
            return;
        }
        foreach ($users as $user) {

            // انتخاب سرویس رندوم
            $serviceName = array_rand($services);
            $service = $services[$serviceName];

            $title = collect($service['titles'])->random();
            $description = collect($service['descriptions'])->random();
            $price = rand(10, 100) * 100_000;
            $formattedPrice = number_format($price);

            // ساخت آگهی
            $ad = Advatisement::create([
                'user_id'     => $user->id,
                'title'       => $title,
                'description' => $description,
                'service_type'=> $serviceName,
                'price'       => $formattedPrice,
                'status'      => 'active',
                'expires_at'  => Carbon::now()->addDays(30),
            ]);

            $possibleTags = ['متمایز', null];

            $tagName = collect($possibleTags)->random();            

            if ($tagName) {
                $tag = ServicesTag::where('name', $tagName)->first();
                if ($tag) {
                    $ad->tags()->attach($tag->id);
                }
            }
            
            // انتخاب تصاویر رندوم (حداقل 2)
            $selectedImages = collect($imagesPool)->shuffle()->take(rand(2, 4));

            foreach ($selectedImages as $index => $image) {
                AdImage::create([
                    'ads_id' => $ad->id,
                    'image_path'       => $image,
                    'is_main'          => $index === 0, // فقط اولی main
                ]);
            }
        }
    }
}
