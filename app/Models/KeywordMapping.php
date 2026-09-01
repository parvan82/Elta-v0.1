<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeywordMapping extends Model
{
    use HasFactory;

    protected $table = 'keyword_mapping';

    protected $fillable = [
        'skill_id',
        'keyword_id',
    ];

    public function skill()
    {
        return $this->belongsTo(UserSkill::class, 'skill_id');
    }

    public function keyword()
    {
        return $this->belongsTo(Keyword::class, 'keyword_id');
    }
}
