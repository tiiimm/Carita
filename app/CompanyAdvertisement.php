<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyAdvertisement extends Model
{
    protected $fillable = [
        'company_id', 'name', 'advertisement', 'advertisement_type', 'status', 'views', 'billing_date', 'charity_id'
    ];

    public function company() {
        return $this->belongsTo('App\Company');
    }

    public function charity() {
        return $this->belongsTo('App\Charity');
    }

    public function watchable() {
        return $this->morphMany('App\WatchLog', 'watchable');
    }

    public function payment() {
        return $this->hasMany('App\CompanyAdvertisementPayment');
    }

    public function advertisable() {
        return $this->morphMany('App\WatchLog', 'advertisable');
    }
}
