<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chatify\Traits\UUID;
use App\Models\User;

class ChMessage extends Model
{
    use UUID;

    protected $table = 'ch_messages';

    protected $fillable = [
        'from_id', 'to_id', 'body', 'attachment'
    ];

    public function from()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
}
