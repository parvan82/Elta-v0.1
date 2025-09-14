<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobHistory extends Model
{
    use HasFactory;

    protected $table = 'job_history';

    protected $fillable = [
        'user_id',
        'job_title',
        'job_position',
        'company_name',
        'start_date',
        'end_date',
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // ارتباط صحیح با کاربر
    }
}
