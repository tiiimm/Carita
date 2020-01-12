<?php

namespace App\Http\Controllers;

use App\Charity;
use Illuminate\Http\Request;

class CharityController extends Controller
{
    public function upload_achievement() {
        \App\User::find(request('user_id'))->charity->achievements()->create(request()->all());

        return ['success' => true];
    }
    
    public function upload_event() {
        \App\User::find(request('user_id'))->charity->events()->create(request()->all());

        return ['success' => true];
    }
    public function get_own_achievements() {
        return \App\User::find(request('user_id'))->charity->achievements;
    }

    public function get_own_events() {
        return \App\User::find(request('user_id'))->charity->events;
    }

    public function get_achievements() {
        return \App\CharityAchievement::all();
    }

    public function get_events() {
        return \App\CharityEvent::all();
    }

    public function get_charities() {
        return \App\Charity::all();
    }

    public function donate() {
        $user = \App\User::find(request('user_id'));
        if (request('type') == 'App\CharityEvent') {
            \App\CharityEvent::find(request('watch_id'))->increment('points');
            $user->watch_log()->create([
                'watchable_id' => request('watch_id'),
                'watchable_type' => request('type'),
                'advertisable_id' => request('ad_id'),
                'advertisable_type' => request('ad_type')
            ]);
        }
        if (request('type') == 'App\Charity') {
            \App\Charity::find(request('watch_id'))->increment('points');
            $user->watch_log()->create([
                'watchable_id' => request('watch_id'),
                'watchable_type' => request('type'),
                'advertisable_id' => request('ad_id'),
                'advertisable_type' => request('ad_type')
            ]);
        }
        if (request('ad_type') == 'Company')
            \App\CompanyAdvertisement::find(request('ad_id'))->increment('views');
        $user->increment('points');
    }
}
