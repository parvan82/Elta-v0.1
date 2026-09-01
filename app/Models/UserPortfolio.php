<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPortfolio extends Model
{
    use HasFactory;

    protected $table = 'user_portfolio';

    protected $fillable = [
        'user_id',         // شناسه کاربر
        'title',           // عنوان پروژه
        'file',            // فایل پروژه
        'description',     // توضیحات پروژه
        'link',            // لینک پروژه (در صورت وجود)
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // هر رکورد نمونه کار به یک کاربر تعلق دارد
    }
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'portfolio_id', 'user_id')->withTimestamps();

    }

    public function likesCount()
    {
        return $this->likes()->count();
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
