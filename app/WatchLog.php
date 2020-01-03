<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchLog extends Model
{
    protected $fillable = [
        'user_id', 'watchable_id', 'watchable_type'
    ];
}
