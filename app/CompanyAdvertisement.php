<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyAdvertisement extends Model
{
    protected $fillable = [
        'company_id', 'advertisement', 'advertisement_type', 'status', 'views'
    ];

    public function company() {
        return $this->belongsTo('App\Company');
    }

    public function advertisable() {
        return $this->morphTo();
    }
}
