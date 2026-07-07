<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    use HasFactory;

    protected $table = 'user_skill';

    protected $fillable = [
        'skill', // نام مهارت
    ];

    public function projects()
    {
        return $this->belongsToMany(NewProject::class, 'skill-mapping', 'skill-id', 'project-id')
            ->withPivot('level');
    }

    public function mappings()
    {
        return $this->hasMany(SkillMapping::class, 'skill_id');
    }
}
