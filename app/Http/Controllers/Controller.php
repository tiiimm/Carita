<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

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

    public function get_profile() {
        return \App\Charity::where('user_id', request('user_id'))->first();
    }

    public function watch_count() {
        return ['watch_count'=> \App\User::find(request('user_id'))->watch_log()->whereDate('created_at', now())->count()];
    }

    public function create_user() {
        $validator = Validator::make(request()->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()->all()]);
        }

        return \App\User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password'),
            'role' => request('role'),
        ]);
    }

    public function change_password() {
        $user = \App\User::find(request('user_id'));
        if (password_verify(request('old_password'), $user->password)) {
            $user->update(['password'=>request('new_password')]);
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
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            if($validator->fails()) {
                return response(['errors' => $validator->errors()->all()]);
            }

            $user = \App\User::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => request('password'),
                'google_id' => request('google_id'),
            ]);

            $user['token']=$user->createToken('Laravel Password Grant Client')->accessToken;
            return $user;
        }
        else {
            if ($user->role == "Charity")
                $user->charity;
            if ($user->role == "Philanthropist")
                $user->philanthropist;
            if ($user->role == "Company")
                $user->company;

            $user['token']=$user->createToken('Laravel Password Grant Client')->accessToken;
            return $user;
        }
    }

    public function logout (Request $request) {
        return $request->user();
        $token = $request->user()->token();
        $token->revoke();
    
        $response = 'You have been succesfully logged out!';
        return response($response, 200);
    }
}
