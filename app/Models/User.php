<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'password',
        'workarea',
        'aboutme',
        'profilepic',
        'role',
        'phone',
        'session_token', // 🔹 اضافه شد
    ];
    protected $hidden = [
        'password',
        'session_token', // 🔹 پنهان در خروجی JSON
    ];
    // روابط دیگر جداول
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function skillMapping()
    {
        return $this->hasMany(SkillMapping::class, 'user_id');
    }

    public function skills()
    {
        return $this->hasManyThrough(
            UserSkill::class,        // جدول نهایی
            SkillMapping::class,     // جدول میانی
            'user_id',               // foreign key در SkillMapping که به User اشاره می‌کنه
            'id',                    // کلید اصلی در UserSkill
            'id',                    // کلید اصلی در User
            'skill_id'               // foreign key در SkillMapping که به UserSkill اشاره می‌کنه
        );
    }


    public function languages()
    {
        return $this->hasMany(UserLanguageLevel::class); // یک کاربر چندین زبان دارد
    }
    // User.php

    public function companies()
    {
        return $this->hasOne(Company::class);
    }

    // app/Models/User.php

    public function personalInformation()
    {
        return $this->hasOne(UserPersonalInformation::class);
    }


    public function educationalHistories()
    {
        return $this->hasMany(UserEducationalHistory::class); // یک کاربر چندین مدرک تحصیلی دارد
    }

    public function jobHistories()
    {
        return $this->hasMany(JobHistory::class); // یک کاربر چندین سابقه شغلی دارد
    }

    public function portfolios()
    {
        return $this->hasMany(UserPortfolio::class); // یک کاربر چندین نمونه کار دارد
    }
    public function getAvatarAttribute()
{
    return $this->profilepic
        ? asset('storage/' . $this->profilepic)
        : asset('images/default.jpg');
}

}
