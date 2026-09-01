<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advatisement extends Model
{
    use HasFactory;

    protected $table = 'advatisement';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'service_type',
        'price',
        'status',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
    public function images()
    {
        return $this->hasMany(AdImage::class, 'ads_id');
    }

    public function mainImage()
    {
        return $this->hasOne(AdImage::class, 'ads_id')->where('is_main', true);
    }

    public function tags()
    {
        return $this->belongsToMany(
            ServicesTag::class,
            'service_type_map',
            'ads_id',      // foreign key در جدول pivot که به advatisement اشاره می‌کنه
            'service_type_id'  // foreign key در جدول pivot که به tag اشاره می‌کنه
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
