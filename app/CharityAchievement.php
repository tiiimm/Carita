<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharityAchievement extends Model
{
    protected $fillable = [
        'charity_id', 'title', 'description', 'venue', 'photo', 'held_on_from', 'held_on_to'
    ];
}
