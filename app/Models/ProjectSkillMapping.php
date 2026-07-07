<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSkillMapping extends Model
{
    use HasFactory;

    protected $table = 'project_skill_mapping';

    protected $fillable = [
        'project_id',
        'skill_id',
        'level',
    ];

    public function project()
    {
        return $this->belongsTo(NewProject::class, 'project_id');
    }

    public function skill()
    {
        return $this->belongsTo(UserSkill::class, 'skill_id');
    }
}
