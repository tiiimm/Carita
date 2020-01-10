<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'user_id', 'name'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function advertisements() {
        return $this->hasMany('App\CompanyAdvertisement');
    }
}
