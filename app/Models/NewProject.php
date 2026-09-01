<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'service',
        'priority',
        'budget',
        'status',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function serviceTags()
    {
        return $this->belongsToMany(ServicesTag::class, 'services_map', 'project_id', 'tag_id');
    }

    public function skills()
    {
        return $this->belongsToMany(UserSkill::class, 'project_skill_mapping', 'project_id', 'skill_id');
    }

    public function projectSkillMappings()
    {
        return $this->hasMany(ProjectSkillMapping::class, 'project_id');
    }

    public function servicesMaps()
    {
        return $this->hasMany(ServicesMap::class, 'project_id');
    }
    public function isOpen()
    {
        return $this->status === 'open';
    }

    public function isClosed()
    {
        return $this->status === 'closed';
    }

    public function isExpired()
    {
        return $this->status === 'expired';
    }

}
