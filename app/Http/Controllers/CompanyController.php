<?php
// app/Http/Controllers/CompanyController.php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function save(Request $request)
    {

        // ولیدیشن داده‌ها
        $data = $request->validate([
            'company_type'        => 'nullable|string|max:100',
            'established_year'    => 'nullable|digits:4|integer',
            'city'                => 'nullable|string|max:100',
            'company_phone'       => 'nullable|string|max:20',
            'national_id'         => 'nullable|string|size:11',
            'company_name'        => 'nullable|string|max:100',
            'company_size'        => 'nullable|string|max:20',
            'company_info'        => 'nullable|string',
        ]);

        // افزودن user_id برای updateOrCreate
        $data['user_id'] = Auth::id();

        // اگر قبلاً ذخیره شده بود، آپدیت کن؛ در غیر این‌صورت ایجاد کن
        $company = Company::updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );

        return redirect()->back()
            ->with('success', 'اطلاعات شرکت با موفقیت ذخیره شد.');
    }
}
