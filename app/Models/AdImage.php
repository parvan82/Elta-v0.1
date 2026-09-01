<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdImage extends Model
{
    use HasFactory;

    protected $table = 'ad_images';

    protected $fillable = [
        'ads_id',
        'image_path',
        'is_main',
    ];

    /**
     * هر تصویر متعلق به یک آگهی است
     */
    public function Advatisement()
    {
        return $this->belongsTo(Advatisement::class, 'ads_id');
    }
}
