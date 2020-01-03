<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    protected $fillable = [
        'user_id', 'points', 'organization', 'contact_number', 'account_name', 'account_number', 'bank', 'address', 'photo', 'description', 'bio_path', 'bio_path_type'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function watchable() {
        return $this->morphTo();
    }

    public function achievements() {
        return $this->hasMany('App\CharityAchievement');
    }

    public function events() {
        return $this->hasMany('App\CharityEvent');
    }
}
