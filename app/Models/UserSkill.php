<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    use HasFactory;

    protected $table = 'user_skill';

    protected $fillable = [
        'skill',
    ];

    public function projects()
    {
        return $this->belongsToMany(NewProject::class, 'skill_mapping', 'skill_id', 'project_id')
            ->withPivot('level');
    }

    // ارتباط با skill_mapping (برای فریلنسرها)
    public function mappings()
    {
        return $this->hasMany(SkillMapping::class, 'skill_id');
    }

    // 🔥 ارتباط با جدول keyword_mapping
    public function keywordMapping()
    {
        return $this->hasMany(KeywordMapping::class, 'skill_id');
    }
}
