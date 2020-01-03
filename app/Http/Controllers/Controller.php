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

    public function set_up()
    {
        $validator = Validator::make(request()->all(), [
            'role' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'integer', 'max:255'],
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        if (request('role') == 'Philanthropist')
        {
            $philanthropist_validator = Validator::make(request()->all(), [
                'user_id' => ['required', 'integer', 'max:255', 'unique:philanthropists', 'unique:charities'],
                'contact_number' => ['sometimes', 'integer', 'unique:philanthropists', 'unique:charities'],
                'birthday' => ['sometimes', 'date'],
                'sex' => ['sometimes', 'string'],
            ]);
            
            if($philanthropist_validator->fails()) {
                return response(['errors' => $philanthropist_validator->errors()->all()], 422);
            }
        }
        elseif (request('role') == 'Charity')
        {
            $charity_validator = Validator::make(request()->all(), [
                'user_id' => ['required', 'integer', 'max:255', 'unique:philanthropists', 'unique:charities'],
                'contact_number' => ['required', 'integer', 'unique:charities', 'unique:philanthropists'],
                'organization' => ['required', 'string', 'max:225', 'unique:charities'], 
                'account_name' => ['required', 'string', 'max:225', 'unique:charities'],
                'account_number' => ['required', 'string', 'max:11', 'unique:charities'], 
                'bank' => ['required', 'string', 'max:225'],
                'address' => ['required', 'string', 'max:225'],
                'description' => ['required', 'string', 'max:225'],
            ]);
            
            if($charity_validator->fails()) {
                return response(['errors' => $charity_validator->errors()->all()], 422);
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
        return $user->philanthropist()->create([
            'contact_number' => request('contact_number'),
            'birthday' => request('birthday'),
            'sex' => request('sex')
        ]);
    }
}
