<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    protected $fillable = [
        'user_id', 'points', 'organization', 'contact_number', 'account_name', 'account_number', 'bank', 'address', 'photo', 'description', 'bio_path', 'bio_path_type'
    ];
}
