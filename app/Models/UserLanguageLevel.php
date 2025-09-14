<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLanguageLevel extends Model
{
    use HasFactory;

    protected $table = 'user_language_level';

    protected $fillable = [
        'user_id',        // شناسه کاربر
        'language',       // نام زبان
        'language_level', // سطح زبان
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // هر زبان به یک کاربر تعلق دارد
    }
}
