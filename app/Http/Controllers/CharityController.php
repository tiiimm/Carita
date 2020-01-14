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
        $user = \App\User::find(request('user_id'))->charity;
        $arri = [];
        $achievements = $user->achievements;
        foreach ($achievements as $achievement) {
            array_push($arri, $achievement);
        }
        $events = $user->events()->whereDate('created_at', '<=', now())->get();
        foreach ($events as $event) {
            array_push($arri, $event);
        }
        return $arri;
    }

    public function get_own_events() {
        $events = \App\User::find(request('user_id'))->charity->events()->whereDate('held_on_from', '>', now())->get();
        if (!$events->isEmpty()){
            $event->charity->user->id;
        }
        return $events;
    }

    public function get_achievements() {
        $arri = [];
        $achievements = \App\CharityAchievement::all();
        foreach ($achievements as $achievement) {
            array_push($arri, $achievement);
        }
        $events = \App\CharityEvent::select('id', 'charity_id', 'title', 'description', 'venue', 'photo', 'held_on_from', 'held_on_to', 'created_at', 'updated_at')->whereDate('created_at', '<=', now())->get();
        foreach ($events as $event) {
            array_push($arri, $event);
        }
        return $arri;
    }

    public function get_events() {
        $events = \App\CharityEvent::whereDate('held_on_from', '>', now())->get();
        if (!$events->isEmpty()){
            $event->charity->user->id;
        }
        return $events;
    }

    public function get_charities() {
        return \App\Charity::where('status', '<>', 'Inactive')->get();
    }

    public function get_active_charities() {
        return \App\Charity::where('status', 'Active')->get();
    }

    public function donate() {
        $user = \App\User::find(request('user_id'));
        if (request('type') == 'App\CharityEvent') {
            $event = \App\CharityEvent::find(request('watch_id'));
            $event->increment('points');
            $user->watch_log()->create([
                'watchable_id' => $event->id,
                'watchable_type' => request('type'),
                'advertisable_id' => request('ad_id'),
                'advertisable_type' => request('ad_type')
            ]);
        }
        if (request('type') == 'App\Charity') {
            $charity = \App\User::find(request('watch_id'))->charity;
            $charity->increment('points');
            $user->watch_log()->create([
                'watchable_id' => $charity->id,
                'watchable_type' => request('type'),
                'advertisable_id' => request('ad_id'),
                'advertisable_type' => request('ad_type')
            ]);
        }
        if (request('ad_type') == 'Company')
            \App\CompanyAdvertisement::find(request('ad_id'))->increment('views');
        $user->increment('points');
        return ['points'=>$user->points];
    }

    public function approve_charity() {
        \App\Charity::find(request('id'))->update(['status'=>'Active']);
    }

    public function delete_charity() {
        \App\Charity::find(request('id'))->update(['status'=>'Inactive']);
    }
}
