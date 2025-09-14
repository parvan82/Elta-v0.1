<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEducationalHistory extends Model
{
    use HasFactory;

    protected $table = 'user_educational_history';

    protected $fillable = [
        'user_id',        // شناسه کاربر
        'degree',         // مدرک تحصیلی
        'major',          // رشته تحصیلی
        'university',     // نام دانشگاه
        'study_city',     // شهر محل تحصیل
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // هر رکورد تحصیلی به یک کاربر تعلق دارد
    }
}
