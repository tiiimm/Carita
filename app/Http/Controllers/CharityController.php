<?php

namespace App\Http\Controllers;

use App\Charity;
use Illuminate\Http\Request;

class CharityController extends Controller
{
    public function get_own_achievements() {
        return \App\User::find(request('user_id'))->charity->achievements;
    }

    public function get_achievements() {
        return \App\CharityAchievement::all();
    }

    public function get_charities() {
        return \App\Charity::all();
    }
    
    public function upload_achievement() {
        \App\User::find(request('user_id'))->charity->achievements()->create(request()->all());

        return ['success' => true];
    }
}
