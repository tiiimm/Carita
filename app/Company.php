<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        // 'user_id', 'name', 'photo', 'status'
        'user_id', 'name', 'logo', 'status', 'charity_id', 'points'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function charity() {
        return $this->belongsTo('App\Charity');
    }

    public function advertisements() {
        return $this->hasMany('App\CompanyAdvertisement');
    }

    public function payment() {
        return $this->hasMany('App\CompanyAdvertisementPayment');
    }
}
