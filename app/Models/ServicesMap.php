<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesMap extends Model
{
    use HasFactory;

    protected $table = 'services_map';

    protected $fillable = [
        'tag_id',
        'project_id',
    ];

    public function tag()
    {
        return $this->belongsTo(ServicesTag::class, 'tag_id');
    }

    public function project()
    {
        return $this->belongsTo(NewProject::class, 'project_id');
    }
}
