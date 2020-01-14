<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function validate_philanthropist() {
        $philanthropist_validator = Validator::make(request()->all(), [
            'user_id' => ['required', 'integer', 'max:255', 'unique:philanthropists', 'unique:charities', 'unique:companies'],
            'contact_number' => ['required', 'integer', 'unique:philanthropists', 'unique:charities'],
        ]);
        
        if($philanthropist_validator->fails()) {
            return response(['errors' => $philanthropist_validator->errors()->all()]);
        }
        return response(['success'=>true]);
    }

    public function validate_charity() {
        $charity_validator = Validator::make(request()->all(), [
            'user_id' => ['required', 'integer', 'max:255', 'unique:philanthropists', 'unique:charities', 'unique:companies'],
            'contact_number' => ['required', 'integer', 'unique:charities', 'unique:philanthropists'],
            'organization' => ['required', 'string', 'max:225', 'unique:charities']
        ]);
        
        if($charity_validator->fails()) {
            return response(['errors' => $charity_validator->errors()->all()]);
        }
        return response(['success'=>true]);
    }

    public function set_up()
    {
        $validator = Validator::make(request()->all(), [
            'role' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'integer', 'max:255'],
            'contact_number' => ['required', 'integer', 'unique:philanthropists', 'unique:charities'],
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()->all()]);
        }

        if (request('role') == 'Charity')
        {
            $charity_validator = Validator::make(request()->all(), [
                'user_id' => ['required', 'integer', 'max:255', 'unique:philanthropists', 'unique:charities', 'unique:companies'],
                'organization' => ['required', 'string', 'max:225', 'unique:charities'], 
                'account_name' => ['required', 'string', 'max:225', 'unique:charities'],
                'account_number' => ['required', 'string', 'max:11', 'unique:charities'], 
                'bank' => ['required', 'string', 'max:225'],
                'address' => ['required', 'string', 'max:225'],
                'description' => ['required', 'string', 'max:225'],
            ]);
            
            if($charity_validator->fails()) {
                return response(['errors' => $charity_validator->errors()->all()]);
            }
        }

        $user = \App\User::findOrFail(request('user_id'));
        $user->update(['role'=>request('role')]);
        if (request('role') == 'Charity')
            return $this->set_up_charity($user);
        elseif (request('role') == 'Philanthropist')
            return $this->set_up_philanthropist($user);
    }

    public function set_up_charity(\App\User $user)
    {
        return $user->charity()->create([
            'points' => 0,
            'status'=>'Pending',
            'organization' => request('organization'),
            'contact_number' => request('contact_number'),
            'account_name' => request('account_name'),
            'account_number' => request('account_number'),
            'bank' => request('bank'),
            'address' => request('address'),
            'photo' => request('photo'),
            'description' => request('description'),
            'bio_path' => request('bio_path'),
            'bio_path_type' => request('bio_path_type')
        ]);
    }

    public function set_up_philanthropist(\App\User $user)
    {
        $user->update(['photo'=>request('photo')]);
        return $user->philanthropist()->create([
            'contact_number' => request('contact_number'),
            'birthday' => request('birthday'),
            'sex' => request('sex')
        ]);
    }

    public function get_profile() {
        return \App\Charity::where('user_id', request('user_id'))->first();
    }

    public function watch_count() {
        return ['watch_count'=> \App\User::find(request('user_id'))->watch_log()->whereDate('created_at', now())->count()];
    }

    public function get_philanthropists() {
        $philanthropists = \App\Philanthropist::all();
        foreach($philanthropists as $philanthropist) {
            $philanthropist->user;
        }
        return $philanthropists;
    }

    public function create_user() {
        $validator = Validator::make(request()->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()->all()]);
        }

        return \App\User::create([
            'name' => request('name'),
            'email' => request('email'),
            'username' => request('username'),
            'points' => 0,
            'photo' => '',
            'role' => request('role'),
            'password' => bcrypt(request('password')),
        ]);
    }

    public function change_password() {
        $user = \App\User::find(request('user_id'));
        if (password_verify(request('old_password'), $user->password)) {
            $user->update(['password'=>bcrypt(request('new_password'))]);
            return 1;
        }
        else return ['error'=>'Incorrect old password'];
    }

    public function google_signup() {
        $user = \App\User::where('google_id', request('google_id'))->first();
        if (is_null($user)) {
            $validator = Validator::make(request()->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            if($validator->fails()) {
                return response(['errors' => $validator->errors()->all()]);
            }

            return \App\User::create([
                'name' => request('name'),
                'email' => request('email'),
                'username' => request('username'),
                'points' => 0,
                'photo' => request('photo'),
                'google_id' => request('google_id'),
                'password' => bcrypt(request('password')),
            ]);
        }
        else {
            return $user;
        }
    }
}
