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
        'company_representative_name',
        'representative_national_code',
        'representative_phone',
        'representative_email',
        'company_phone',
        'national_id',
        'postal_code',
        'city',
        'address',
        'established_year',
    ];
    // Company.php

public function user()
{
    return $this->belongsTo(User::class);
}

}
