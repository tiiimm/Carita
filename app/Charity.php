<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    protected $fillable = [
        // 'user_id', 'points', 'status', 'organization', 'contact_number', 'account_name', 'account_number', 'bank', 'address', 'photo', 'description', 'bio_path', 'bio_path_type'
        'user_id', 'name', 'logo', 'description', 'display', 'display_type', 'bank', 'account_name', 'account_number', 'status', 'points'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function watchable() {
        return $this->morphMany('App\WatchLog', 'watchable');
    }

    public function achievements() {
        return $this->hasMany('App\CharityAchievement');
    }

    public function events() {
        return $this->hasMany('App\CharityEvent');
    }

    public function partnered_companies() {
        return $this->hasMany('App\Company');
    }
}
