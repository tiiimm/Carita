<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyAdvertisementPayment extends Model
{
    protected $fillable = [
        'company_advertisement_id', 'company_id', 'inclusive_from', 'inclusive_to', 'date_paid', 'amount'
    ];

    public function advertisement() {
        return $this->belongsTo('App\CompanyAdvertisement', 'company_advertisement_id');
    }
}
