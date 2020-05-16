<?php

namespace App\Http\Controllers;

use App\Philanthropist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhilanthropistController extends Controller
{
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
