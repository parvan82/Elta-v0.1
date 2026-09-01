<?php
// app/Models/Company.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_type',
        'established_year',
        'city',
        'company_phone',
        'national_id',
        'company_name',
        'company_size',
        'company_info'
    ];
    // Company.php

public function user()
{
    return $this->belongsTo(User::class);
}

}
