<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesTag extends Model
{
    use HasFactory;

    protected $table = 'services_tags';

    protected $fillable = [
        'name',
    ];

    public function projects()
    {
        return $this->belongsToMany(NewProject::class, 'services_map', 'tag_id', 'project_id');
    }
}
