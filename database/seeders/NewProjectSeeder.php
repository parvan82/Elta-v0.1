<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\NewProject;
use App\Models\ServicesTag;
use App\Models\UserSkill;
use Illuminate\Support\Carbon;

class NewProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Budget (متن p)
        $budgets = [
            'زیر 1 میلیون تومان',
            '1 تا 5 میلیون تومان',
            '5 تا 10 میلیون تومان',
            '10 تا 20 میلیون تومان',
            '20 تا 30 میلیون تومان',
            'بیشتر از 30 میلیون تومان',
            'قابل مذاکره',
        ];
 $ServicesTag = [
    'فوری',
    'متمایز',
    'مدیر پروژه',
    'تخصصی',
];

        // Priority (متن p)
        $priorities = [
            'اولویت با کیفیت و دقت کار',
            'اولویت با سرعت و زمان تحویل',
            'اولویت با هزینه کمتر',
            'تعادل بین کیفیت، سرعت و هزینه',
        ];

        // دیتای پروژه + مهارت‌ها
       $projectsData = [
            'برنامه نویسی' => [
                'titles' => [
                    'پیاده‌سازی وب‌سایت با Laravel',
                    'توسعه API برای اپلیکیشن موبایل',
                ],
                'descriptions' => [
                    'به یک برنامه‌نویس حرفه‌ای برای توسعه و نگهداری پروژه تحت وب نیازمندیم. تسلط بر فریم‌ورک‌ها، API و دیتابیس اهمیت بالایی دارد.',
                ],
                'skills' => [
                    'php' => [3, 5],
                    'Laravel' => [3, 5],
                    'Rest API' => [2, 4],
                    'MySql' => [2, 4],
                    'GIT' => [2, 4],
                ],
            ],

            'طراحی گرافیک' => [
                'titles' => [
                    'طراحی UI/UX اپلیکیشن موبایل',
                    'طراحی رابط کاربری وب‌سایت',
                ],
                'descriptions' => [
                    'نیازمند طراح خلاق برای طراحی رابط کاربری مدرن و کاربرپسند با رعایت اصول UX و استانداردهای طراحی.',
                ],
                'skills' => [
                    'Figma' => [3, 5],
                    'Adobe XD' => [3, 5],
                    'Adobe Photoshop' => [2, 4],
                    'Adobe Illustrator' => [2, 4],
                ],
            ],

            'تولید محتوا' => [
                'titles' => [
                    'تولید محتوای سئو شده برای وبلاگ',
                    'مدیریت و تولید محتوا برای سایت',
                ],
                'descriptions' => [
                    'تولید محتوای یونیک و بهینه‌سازی شده برای موتورهای جستجو با استفاده از ابزارهای تحلیل و تحقیق کلمات کلیدی.',
                ],
                'skills' => [
                    'Wordpress' => [2, 4],
                    'Google Search Console' => [2, 4],
                    'Keyword Planner' => [3, 5],
                    'Ahrefs' => [2, 4],
                    'Semrush' => [2, 4],
                ],
            ],

        ];


        // فقط کارفرماها + بدون پروژه
        $users = User::where('role', 'employer')
            ->whereDoesntHave('NewProject')
            ->get();

        if ($users->isEmpty()) {
            $this->command->warn('هیچ کارفرمایی بدون پروژه پیدا نشد');
            return;
        }

        foreach ($users as $user) {

            $serviceName = array_rand($projectsData);
            $data = $projectsData[$serviceName];

            $project = NewProject::create([
                'user_id'     => $user->id,
                'title'       => collect($data['titles'])->random(),
                'description' => collect($data['descriptions'])->random(),
                'service'     => $serviceName,
                'budget'      => collect($budgets)->random(),     // ✅ متن p
                'priority'    => collect($priorities)->random(),  // ✅ متن p
                'status'      => 'open',
                'expires_at'  => Carbon::now()->addDays(rand(15, 45)),
            ]);
$tags = [];
foreach ($ServicesTag as $tagName) {
    $tags[] = ServicesTag::firstOrCreate(['name' => $tagName]);
}

// تعداد تگ‌های رندوم برای attach (0 تا 2)
$tagsCount = rand(0, 2);

// انتخاب تگ‌های رندوم و attach
$randomTags = collect($tags)->shuffle()->take($tagsCount);

foreach ($randomTags as $tag) {
    $project->serviceTags()->syncWithoutDetaching($tag->id);
}
            if ($tag) {
                $project->serviceTags()->attach($tag->id);
            }

            foreach ($data['skills'] as $skillName => $range) {
            
                $skill = UserSkill::firstOrCreate([
                    'skill' => $skillName
                ]);
            
                $project->skills()->syncWithoutDetaching([$skill->id]);
            }


            $this->command->info("Project seeded for employer ID: {$user->id}");
        }
    }
}
