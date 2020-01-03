<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Philanthropist extends Model
{
    protected $fillable = [
        'user_id', 'contact_number', 'birthday', 'sex'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}