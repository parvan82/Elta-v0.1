<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPersonalInformation extends Model
{
    use HasFactory;

    protected $table = 'user_personal_information';

    protected $fillable = [
        'user_id',         // شناسه کاربر
        'residence_city',  // شهر محل سکونت
        'gender',          // جنسیت
        'birth_date',      // تاریخ تولد
        'military_status', // وضعیت نظام وظیفه
        'personal_id',     // شماره شناسنامه
        'mobile_number',   // شماره موبایل
        'email',           // ایمیل
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
