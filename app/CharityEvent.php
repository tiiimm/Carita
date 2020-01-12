<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharityEvent extends Model
{
    protected $fillable = [
        'charity_id', 'title', 'description', 'venue', 'photo', 'points', 'held_on_from', 'held_on_to', 'open_from', 'open_to'
    ];

    public function charity() {
        return $this->belongsTo('App\Charity');
    }

    public function watchable() {
        return $this->morphMany('App\WatchLog', 'watchable');
    }
}
