<?php

namespace App\Http\Controllers;

use DB;

use App\Charity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CharityController extends Controller
{
    public function get_supports(Request $request, Charity $charity) {
        $months=[
            '01' => 0,
            '02' => 0,
            '03' => 0,
            '04' => 0,
            '05' => 0,
            '06' => 0,
            '07' => 0,
            '08' => 0,
            '09' => 0,
            '10' => 0,
            '11' => 0,
            '12' => 0,
        ];
        $event_months=[
            '01' => 0,
            '02' => 0,
            '03' => 0,
            '04' => 0,
            '05' => 0,
            '06' => 0,
            '07' => 0,
            '08' => 0,
            '09' => 0,
            '10' => 0,
            '11' => 0,
            '12' => 0,
        ];
        $ad_months=[
            '01' => 0,
            '02' => 0,
            '03' => 0,
            '04' => 0,
            '05' => 0,
            '06' => 0,
            '07' => 0,
            '08' => 0,
            '09' => 0,
            '10' => 0,
            '11' => 0,
            '12' => 0,
        ];
        
        $companies = $charity->partnered_companies()->with('advertisements')->get();
        foreach($companies as $company) {
            foreach($company->advertisements as $advertisement) {
                $ad_points = $advertisement->watchable()->where(DB::raw('YEAR(created_at)'), $request['year'])->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as points'))->groupBy('month')->get();

                foreach($ad_points as $ad_point) {
                    if ($ad_point->month == 1)
                        $ad_months['01']+=$ad_point->points;
                    if ($ad_point->month == 2)
                        $ad_months['02']+=$ad_point->points;
                    if ($ad_point->month == 3)
                        $ad_months['03']+=$ad_point->points;
                    if ($ad_point->month == 4)
                        $ad_months['04']+=$ad_point->points;
                    if ($ad_point->month == 5)
                        $ad_months['05']+=$ad_point->points;
                    if ($ad_point->month == 6)
                        $ad_months['06']+=$ad_point->points;
                    if ($ad_point->month == 7)
                        $ad_months['07']+=$ad_point->points;
                    if ($ad_point->month == 8)
                        $ad_months['08']+=$ad_point->points;
                    if ($ad_point->month == 9)
                        $ad_months['09']+=$ad_point->points;
                    if ($ad_point->month ==10)
                        $ad_months['10']+=$ad_point->points;
                    if ($ad_point->month ==11)
                        $ad_months['11']+=$ad_point->points;
                    if ($ad_point->month ==12)
                        $ad_months['12']+=$ad_point->points;
                }
            }
        }

        $events = $charity->events()->with('watchable')->get();
        foreach ($events as $event) {
                $event_points= $event->watchable()->where(DB::raw('YEAR(created_at)'), $request['year'])->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as points'))->groupBy('month')->get();

                foreach($event_points as $event_point) {
                    if ($event_point->month == 1)
                        $event_months['01']+=$event_point->points;
                    if ($event_point->month == 2)
                        $event_months['02']+=$event_point->points;
                    if ($event_point->month == 3)
                        $event_months['03']+=$event_point->points;
                    if ($event_point->month == 4)
                        $event_months['04']+=$event_point->points;
                    if ($event_point->month == 5)
                        $event_months['05']+=$event_point->points;
                    if ($event_point->month == 6)
                        $event_months['06']+=$event_point->points;
                    if ($event_point->month == 7)
                        $event_months['07']+=$event_point->points;
                    if ($event_point->month == 8)
                        $event_months['08']+=$event_point->points;
                    if ($event_point->month == 9)
                        $event_months['09']+=$event_point->points;
                    if ($event_point->month ==10)
                        $event_months['10']+=$event_point->points;
                    if ($event_point->month ==11)
                        $event_months['11']+=$event_point->points;
                    if ($event_point->month ==12)
                        $event_months['12']+=$event_point->points;
                }
        }

        $points = $charity->watchable()->where(DB::raw('YEAR(created_at)'), $request['year'])->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as points'))
        ->groupBy('month')
        ->get();

        foreach($points as $point) {
            if ($point->month == 1)
                $months['01']=$point->points;
            if ($point->month == 2)
                $months['02']=$point->points;
            if ($point->month == 3)
                $months['03']=$point->points;
            if ($point->month == 4)
                $months['04']=$point->points;
            if ($point->month == 5)
                $months['05']=$point->points;
            if ($point->month == 6)
                $months['06']=$point->points;
            if ($point->month == 7)
                $months['07']=$point->points;
            if ($point->month == 8)
                $months['08']=$point->points;
            if ($point->month == 9)
                $months['09']=$point->points;
            if ($point->month ==10)
                $months['10']=$point->points;
            if ($point->month ==11)
                $months['11']=$point->points;
            if ($point->month ==12)
                $months['12']=$point->points;
        }

        return ['charity'=>$months, 'event_points'=>$event_months, 'ad_points'=>$ad_months];
    }

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
        else if ($request->user()->role == "Company") {
            if (!is_null($request->user()->company->charity_id))
                return 'Partnered';
            else return \App\Charity::where('status', 'Approved')->with('user')->get();
        }
        else
            return \App\Charity::where('status', 'Approved')->with('user')->get();
    }

    public function show(Request $request, Charity $charity) {
        $charity['donate'] = true;
        if ($request->user()->role == "Charity")
            if ($charity->id == $request->user()->charity->id)
                $charity['donate'] = false;
        if ($request->user()->role == "Company")
            if ($charity->id == $request->user()->company->charity_id)
                $charity['donate'] = false;
        $charity->user;
        
        $ads = \App\CompanyAdvertisement::where('status', 'Active')->get();
        foreach ($ads as $key => $ad) {
            if (!is_null($ad->charity_id))
                if ($ad->charity_id <> $charity->id)
                    unset($ads[$key]);
        }
        $charity['ads']=$ads;
        return $charity;
    }

    public function show_event(Request $request, \App\CharityEvent $event) {
        $event->charity;
        $event['donate'] = true;
        if ($request->user()->role == "Charity")
            if ($event->charity->id == $request->user()->charity->id)
                $event['donate'] = false;
        if ($request->user()->role == "Company")
            if ($event->charity->id == $request->user()->company->charity_id)
                $event['donate'] = false;

        $ads = \App\CompanyAdvertisement::where('status', 'Active')->get();
        foreach ($ads as $key => $ad) {
            if (!is_null($ad->charity_id))
                if ($ad->charity_id <> $event->charity->id)
                    unset($ads[$key]);
        }
        $event['ads']=$ads;
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
