<?php

namespace App\Http\Controllers;

use DB;

use App\Philanthropist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhilanthropistController extends Controller
{
    public function get_points(Request $request, \App\User $user) {
        $months=[
            '01' => "",
            '02' => "",
            '03' => "",
            '04' => "",
            '05' => "",
            '06' => "",
            '07' => "",
            '08' => "",
            '09' => "",
            '10' => "",
            '11' => "",
            '12' => "",
        ];

        // $points = $user->watch_log()->where(DB::raw('YEAR(created_at)'), $request['year'])->get();
            
        $points = $user->watch_log()->where(DB::raw('YEAR(created_at)'), $request['year'])->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as points'))
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

        return $months;
    }

    public function set_up_philanthropist(Request $request, \App\User $user)
    {
        $validator = Validator::make(request()->all(), [
            'role' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:225', 'unique:philanthropists'],
            'contact_number' => ['required', 'integer', 'unique:users'],
            'profile_picture' => ['required', 'string', 'max:225']
        ]);
        
        if($validator->fails()) {
            return response(['errors' => $validator->errors()->all()]);
        }

        if (empty(request('address')))
            $request['address'] = "";

        if (empty(request('birthday')))
            $request['birthday'] = "";

        if (empty(request('sex')))
            $request['sex'] = "";

        $user->update(request()->all());
        return $user->philanthropist()->create(request()->all());
    }

    public function get_philanthropists() {
        $philanthropists = \App\Philanthropist::all();
        foreach($philanthropists as $philanthropist) {
            $philanthropist->user;
        }
        return $philanthropists;
    }
}
