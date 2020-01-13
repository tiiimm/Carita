<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function set_up_company() {
        $validator = Validator::make(request()->all(), [
            'user_id' => ['required', 'integer', 'max:255', 'unique:philanthropists', 'unique:charities', 'unique:companies'],
            'name' => ['required', 'string', 'max:255', 'unique:companies']
        ]);
        
        if($validator->fails()) {
            return response(['errors' => $validator->errors()->all()]);
        }

        $user = \App\User::find(request('user_id'));
        $user->update(['role'=>'Company']);
        return $user->company()->create(request()->all());
    }

    public function upload_advertisement() {
        $user = \App\User::find(request('user_id'));
        $user->company->advertisements()->create(request()->all());
        return ['success'=>true];
    }

    public function get_own_advertisements(\App\User $user) {
        return \App\User::find(request('user_id'))->company->advertisements;
    }

    public function get_advertisements() {
        return \App\CompanyAdvertisement::all();
    }

    public function get_companies() {
        return \App\Company::all();
    }
}
