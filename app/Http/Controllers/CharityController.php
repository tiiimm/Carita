<?php

namespace App\Http\Controllers;

use App\Charity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CharityController extends Controller
{
    public function get_feeds() {
        $feeds = [];
        $charities = \App\Charity::where('status', 'Approved')->with('user')->get();
        if (!$charities->isEmpty()) {
            foreach($charities as $charity) {
                $charity['class']='charity';
                array_push($feeds, $charity);
            }
        }
        // $companies = \App\Company::where('status', 'Approved')->with('charity', 'user')->get();
        // if (!$companies->isEmpty())
        //     foreach($companies as $company) {
        //         $company['class']='company';
        //         array_push($feeds, $company);
        //     }
        $achievements = \App\CharityAchievement::all();
        if (!$achievements->isEmpty())
            foreach($achievements as $achievement) {
                $achievement['class']='achievement';
                array_push($feeds, $achievement);
            }
        $events = \App\CharityEvent::all();
        if (!$events->isEmpty())
            foreach($events as $event) {
                $event['class']='event';
                array_push($feeds, $event);
            }
        $ads = \App\CompanyAdvertisement::with('company', 'charity')->get();
        foreach($ads as $ad) {
            $ad['active_until'] = $ad->payment()->latest()->first()['inclusive_to'];
            if ($ad['active_until'] < date('Y-m-d'))
                $ad['status'] = 'Inactive';
        }
        if (!$ads->isEmpty())
            foreach($ads as $ad) {
                $ad['class']='ad';
                array_push($feeds, $ad);
            }
        usort($feeds, function($a, $b) {
            return $b['created_at'] <=> $a['created_at'];
        });
        return $feeds;
    }

    public function set_up_charity(\App\User $user)
    {
        $validator = Validator::make(request()->all(), [
            'role' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'integer', 'unique:users'],
            'address' => ['required', 'string', 'max:225'],
            'name' => ['required', 'string', 'max:225', 'unique:charities'],
            'logo' => ['required', 'string', 'max:225'],
            'description' => ['required', 'string', 'max:225'],
            'bank' => ['required', 'string', 'max:225'],
            'account_name' => ['required', 'string', 'max:225', 'unique:charities'],
            'account_number' => ['required', 'string', 'max:225', 'unique:charities'],
        ]);
        
        if($validator->fails()) {
            return response(['errors' => $validator->errors()->all()]);
        }
        
        $user->charity()->create(request()->all());
        $user->update([
            'role' => request('role'),
            'contact_number' => request('contact_number'),
            'address' => request('address')
        ]);

        return $user->charity;
    }

    public function approve_charity(Charity $charity) {
        $charity->update(['status'=>'Approved']);
        return $charity;
    }

    public function reject_charity(Charity $charity) {
        $charity->update(['status'=>'Rejected']);
        return $charity;
    }

    public function get_charities(Request $request) {
        if ($request->user()->role == "Administrator")
            return \App\Charity::with('user')->get();
        else
            return \App\Charity::where('status', 'Approved')->with('user')->get();
    }

    public function show(Charity $charity) {
        $charity->user;
        $charity->ads = \App\CompanyAdvertisement::where('status', 'Active')->get();
        return $charity;
    }

    public function show_event(\App\CharityEvent $event) {
        $event->charity;
        $event->ads = \App\CompanyAdvertisement::where('status', 'Active')->get();
        return $event;
    }

    public function show_achievement(\App\CharityAchievement $achievement) {
        return $achievement;
    }

    public function get_achievements() {
        return \App\CharityAchievement::all();
    }

    public function get_own_achievements(Charity $charity) {
        return $charity->achievements;
    }

    public function get_events() {
        return \App\CharityEvent::all();
    }

    public function get_own_events(Charity $charity) {
        return $charity->events;
    }

    public function upload_achievement(\App\User $user) {
        $user->charity->achievements()->create(request()->all());

        return ['success' => true];
    }
    
    public function upload_event(\App\User $user) {
        $user->charity->events()->create(request()->all());

        return ['success' => true];
    }

    public function delete_charity() {
        \App\Charity::find(request('id'))->update(['status'=>'Inactive']);
    }

    public function donate(\App\User $user) {
        $user->increment('points');
        
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
        elseif (request('type') == 'App\Charity') {
            $charity = \App\Charity::find(request('watch_id'));
            $charity->increment('points');

            $user->watch_log()->create([
                'watchable_id' => $charity->id,
                'watchable_type' => request('type'),
                'advertisable_id' => request('ad_id'),
                'advertisable_type' => request('ad_type')
            ]);
        }
        elseif (request('type') == 'App\CompanyAdvertisement') {
            $ads = \App\CompanyAdvertisement::find(request('ad_id'));
            $ads->charity->increment('points');

            $user->watch_log()->create([
                'watchable_id' => $ads->id,
                'watchable_type' => request('type'),
                'advertisable_id' => request('ad_id'),
                'advertisable_type' => request('ad_type')
            ]);
        }

        if (request('ad_type') == 'Company') {
            $ads = \App\CompanyAdvertisement::find(request('ad_id'));
            $ads->increment('views');
            $ads->company->increment('points');
        }
            
        return ['points'=>$user->points];
    }





    

    // public function get_active_charities() {
    //     return \App\Charity::where('status', 'Active')->get();
    // }

    // public function approve_charity() {
    //     \App\Charity::find(request('id'))->update(['status'=>'Active']);
    // }
}
