<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchLog extends Model
{
    protected $fillable = [
        'user_id', 'watchable_id', 'watchable_type'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function charity() {
        return $this->morphMany('App\Charity');
    }

    public function event() {
        return $this->morphMany('App\Event');
    }
}
