<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillMapping extends Model
{
    use HasFactory;

    protected $table = 'skill_mapping';

    protected $fillable = [
        'user_id',
        'skill_id', // آیدی مهارتی که از جدول user_skills آمده
        'level',          // سطح مهارت
    ];

    // هر mapping مربوط به یک کاربر است
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // هر mapping به یک skill کلی اشاره دارد
    public function skill()
    {
        return $this->belongsTo(UserSkill::class, 'skill_id');
    }

}
