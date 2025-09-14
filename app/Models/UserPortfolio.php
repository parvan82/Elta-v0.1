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
}
