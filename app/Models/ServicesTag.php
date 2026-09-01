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

    public function ads()
    {
        return $this->belongsToMany(
            Advatisement::class,
            'service_type_map',
            'services_id', // foreign key در pivot
            'ads_id'       // foreign key در pivot
        );
    }
}
