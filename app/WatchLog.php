<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchLog extends Model
{
    protected $fillable = [
        'user_id', 'watchable_id', 'watchable_type', 'advertisable_id', 'advertisable_type'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function charity() {
        return $this->morphTo();
    }

    public function event() {
        return $this->morphMany('App\Event');
    }

    public function advertisement() {
        return $this->morphMany('App\CompanyAdvertisement');
    }
}
