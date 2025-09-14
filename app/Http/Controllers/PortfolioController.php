<?php
namespace App\Http\Controllers;

use App\Models\SkillMapping;
use Illuminate\Http\Request;
use App\Models\UserSkill;
use App\Models\UserLanguageLevel;
use App\Models\UserPersonalInformation;
use App\Models\UserEducationalHistory;
use App\Models\JobHistory;
use App\Models\UserPortfolio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\CalendarUtils; // برای تبدیل تاریخ شمسی به میلادی

// تبدیل اعداد فارسی به انگلیسی
function convertPersianToEnglish($number) {
    return strtr($number, [
        '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
        '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9'
    ]);
}

class PortfolioController extends Controller
{
    public function store(Request $request)
    {
        $userId = Auth::id();

        // ذخیره اطلاعات شخصی
        if ($request->has('PersonalStatus')) {
            $personalData = $request->PersonalStatus;

            // تبدیل تاریخ تولد از شمسی به میلادی و اعداد فارسی به انگلیسی
            $birthDateShamsi = convertPersianToEnglish($personalData['birthDate']);
            $birthDateMiladi = CalendarUtils::createCarbonFromFormat('Y/m/d', $birthDateShamsi)->toDateString();

            UserPersonalInformation::updateOrCreate(
                ['user_id' => $userId], // اگر قبلاً اطلاعات وجود داشته باشد، بروزرسانی شود
                [
                    'residence_city' => $personalData['residenceCity'],
                    'gender' => $personalData['gender'],
                    'birth_date' => $birthDateMiladi, // ذخیره تاریخ میلادی
                    'military_status' => $personalData['militaryStatus'],
                    'personal_id' => convertPersianToEnglish($personalData['nationalID']),
                    'email' => $personalData['email'],
                ]
            );
            User::updateOrCreate(
                ['id' => $userId], // اگر قبلاً اطلاعات وجود داشته باشد، بروزرسانی شود
                [
                    'phone' => convertPersianToEnglish($personalData['phone']),
                ]
            );
        }

        // ذخیره مهارت‌ها
        if ($request->has('StatusSkills')) {
            foreach ($request->StatusSkills as $skillData) {
                // پیدا کردن مهارت با نام
                $skill = UserSkill::where('skill', $skillData['skill'])->first();

                // اگه مهارت پیدا نشد، ردش کن
                if (!$skill) {
                    continue;
                }

                // ثبت اطلاعات در skill_mapping
                SkillMapping::create([
                    'user_id'  => $userId,
                    'skill_id' => $skill->id,
                    'level'    => $skillData['level'],
                ]);
            }
        }


        // ذخیره زبان‌ها
        if ($request->has('StatusLanguages')) {
            foreach ($request->StatusLanguages as $language) {
                UserLanguageLevel::create([
                    'user_id' => $userId,
                    'language' => $language['language'],
                    'language_level' => $language['level'],
                ]);
            }
        }

        // ذخیره اطلاعات پروفایل کاربر
        if ($request->has('profileData')) {
            $user = User::find($userId);
            if ($user) {
                $user->name = $request->profileData['fullName']; // ذخیره نام و نام خانوادگی
                $user->workarea = $request->profileData['workField'];
                $user->aboutme = $request->profileData['aboutMe'];

                // ذخیره تصویر پروفایل (اگر داده Base64 باشد)
                if (!empty($request->profileData['profileImage'])) {
                    $imageData = $request->profileData['profileImage'];

                    // بررسی اینکه آیا داده، Base64 است
                    if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $matches)) {
                        $extension = strtolower($matches[1]); // استخراج فرمت فایل

                        // بررسی اینکه فرمت معتبر است
                        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                        if (!in_array($extension, $allowedExtensions)) {
                            return response()->json(['error' => 'فرمت تصویر نامعتبر است.'], 400);
                        }

                        // حذف پیشوند Base64
                        $imageBase64 = substr($imageData, strpos($imageData, ',') + 1);
                        $imageBase64 = base64_decode($imageBase64);

                        // بررسی حجم تصویر (نباید بیشتر از 2MB باشد)
                        if (strlen($imageBase64) > 2 * 1024 * 1024) {
                            return response()->json(['error' => 'حجم تصویر نباید بیشتر از 2MB باشد.'], 400);
                        }

                        // ایجاد نام تصادفی برای فایل
                        $fileName = 'profile_' . md5(time() . uniqid()) . '.' . $extension;
                        Storage::disk('public')->put("profile_images/$fileName", $imageBase64);

                        // مسیر صحیح برای نمایش تصویر
                        $user->profilepic = "profile_images/$fileName";
                    } elseif ($request->hasFile('profileData.profileImage')) {
                        // **حالت فایل آپلود شده**
                        $imagePath = $request->file('profileData.profileImage')->store('public/profile_images');
                        $user->profilepic = str_replace('public/', '', $imagePath);
                    }
                }

                $user->save();
            }
        }



        // ذخیره اطلاعات تحصیلی
        if ($request->has('StatusEducation')) {
            foreach ($request->StatusEducation as $education) {
                UserEducationalHistory::create([
                    'user_id' => $userId,
                    'degree' => $education['degree'],
                    'major' => $education['fieldOfStudy'],
                    'university' => $education['university'],
                    'study_city' => $education['city'],
                ]);
            }
        }

        // ذخیره سوابق شغلی
        if ($request->filled('StatusJobs') && is_array($request->StatusJobs)) {
            foreach ($request->StatusJobs as $job) {
                // تبدیل تاریخ‌های شمسی به میلادی و اعداد فارسی به انگلیسی
                $startDateShamsi = convertPersianToEnglish($job['startDate']);
                $startDateMiladi = CalendarUtils::createCarbonFromFormat('Y/m/d', $startDateShamsi)->toDateString();

                $endDateMiladi = null; // مقدار پیش‌فرض
                if (!empty($job['endDate'])) {
                    $endDateShamsi = convertPersianToEnglish($job['endDate']);
                    $endDateMiladi = CalendarUtils::createCarbonFromFormat('Y/m/d', $endDateShamsi)->toDateString();
                }


                JobHistory::create([
                    'user_id'       => $userId,
                    'job_title'     => $job['jobTitle'],
                    'job_position'  => $job['jobPosition'],
                    'company_name'  => $job['organizationName'],
                    'start_date'    => $startDateMiladi, // ذخیره تاریخ میلادی
                    'end_date'      => $endDateMiladi,   // ذخیره تاریخ میلادی
                ]);
            }
        }


        // ذخیره پورتفولیو
        if ($request->has('portfolioData')) {
            $portfolioData = $request->portfolioData;

            // ذخیره اطلاعات در جدول user_portfolio
            $portfolio = new UserPortfolio();
            $portfolio->user_id = auth()->user()->id;
            $portfolio->title = $portfolioData['title'];
            $portfolio->description = $portfolioData['description'];
            $portfolio->link = $portfolioData['link'] ?? null;

            // ذخیره فایل در مسیر صحیح
            if ($request->hasFile('portfolioData.file')) {
                $file = $request->file('portfolioData.file');
                $path = $file->store('portfolio_files', 'public');  // تغییر مسیر به storage/app/public/portfolio_files
                $portfolio->file = "storage/" . $path;  // مسیر دسترسی از public
            }

            $portfolio->save();

        }


        return response()->json(['success' => true]);


    }

    // داخل UserLanguageController.php
    public function deleteLanguage($id)
    {
        // پیدا کردن زبان مورد نظر برای کاربر وارد شده
        $language = Auth::user()->languages()->find($id);

        // اگر زبان پیدا شد، آن را حذف کن
        if ($language) {
            $language->delete();
            return response()->json(['success' => true, 'message' => 'زبان با موفقیت حذف شد.']);
        }

        // اگر زبان پیدا نشد
        return response()->json(['success' => false, 'message' => 'زبان پیدا نشد.']);
    }

    // متد حذف سابقه تحصیلی
    public function deleteEducation($id)
    {
        $user = Auth::user(); // دریافت کاربر لاگین شده
        $education = $user->educationalHistories()->find($id); // پیدا کردن سوابق تحصیلی با توجه به ID

        if ($education) {
            $education->delete(); // حذف سوابق تحصیلی
            return response()->json(['success' => true, 'message' => 'سابقه تحصیلی با موفقیت حذف شد.']);
        }

        return response()->json(['success' => false, 'message' => 'سابقه تحصیلی پیدا نشد.']);
    }

    // متد ویرایش سابقه تحصیلی
    public function EducationalUpdate(Request $request)
    {
        // اعتبارسنجی ورودی‌ها
        $request->validate([
            'id' => 'required|exists:user_educational_history,id',
            'degree' => 'required|string|max:255',
            'field' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        // پیدا کردن سابقه تحصیلی با شناسه
        $educationalHistory = UserEducationalHistory::find($request->id);

        // بروزرسانی مقادیر
        $educationalHistory->degree = $request->degree;
        $educationalHistory->major = $request->field;
        $educationalHistory->university = $request->university;
        $educationalHistory->study_city = $request->city;

        // ذخیره تغییرات
        $educationalHistory->save();

        // پاسخ موفقیت‌آمیز به درخواست
        return response()->json(['success' => true, 'message' => 'سابقه تحصیلی با موفقیت به‌روزرسانی شد.']);
    }
    public function deleteSkill($id)
    {
        $mapping = SkillMapping::find($id);

        if ($mapping && $mapping->user_id === auth()->id()) {
            $mapping->delete();
            return response()->json(['success' => true, 'message' => 'مهارت با موفقیت حذف شد.']);
        }

        return response()->json(['success' => false, 'message' => 'مهارت پیدا نشد یا اجازه دسترسی ندارید.']);
    }

    public function deleteJob($id)
    {
        // پیدا کردن سوابق شغلی با شناسه مشخص شده
        $job = JobHistory::find($id);

        // اگر سوابق شغلی پیدا شد، آن را حذف می‌کنیم
        if ($job) {
            $job->delete();
            return response()->json(['message' => 'سابقه شغلی با موفقیت حذف شد']);
        } else {
            return response()->json(['message' => 'سوابق شغلی پیدا نشد.'], 404);
        }
    }
    public function JobUpdate(Request $request , $id)
    {
        // اعتبارسنجی داده‌های ورودی
        $request->validate([
            'job_title' => 'required|string|max:255',
            'job_position' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'required|string|max:255',
        ]);

        // پیدا کردن شغل با استفاده از شناسه
        $job = JobHistory::findOrFail($id);

        // به‌روزرسانی اطلاعات شغل
        $job->job_title = $request->input('job_title');
        $job->job_position = $request->input('job_position');
        $job->company_name = $request->input('company_name');
        $job->start_date = $request->input('start_date');
        $job->end_date = $request->input('end_date');

        // ذخیره تغییرات در دیتابیس
        $job->save();

        return response()->json(['success' => true, 'message' => 'اطلاعات شغلی با موفقیت ویرایش شد']);
    }
    public function deletePortfolio($id)
    {
        $portfolio = UserPortfolio::find($id);

        if (!$portfolio) {
            return response()->json(['success' => false, 'message' => 'نمونه کار یافت نشد.'], 404);
        }

        $portfolio->delete();

        return response()->json(['success' => true, 'message' => 'نمونه کار حذف شد.']);
    }

    public function showPortfolio($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'freelancer') {
            $data = [
                'user' => $user,
                'personalInfo' => $user->personalInformation,
                'skills' => $user->skills,
                'languages' => $user->languages,
                'education' => $user->educationalHistories,
                'jobHistories' => $user->jobHistories,
                'portfolios' => $user->portfolios,
            ];

            return view('portfolioPage', $data);

        } elseif ($user->role === 'employer') {
            $company = $user->companies;



            return view('portfolioPage', [
                'user' => $user,
                'company' => $company
            ]);
        }

    }
}

