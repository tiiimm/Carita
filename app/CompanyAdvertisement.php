<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyAdvertisement extends Model
{
    protected $fillable = [
        'company_id', 'name', 'advertisement', 'advertisement_type', 'status', 'views', 'billing_date'
    ];

    public function company() {
        return $this->belongsTo('App\Company');
    }

    public function advertisable() {
        return $this->morphMany('App\WatchLog', 'advertisable');
    }
}
