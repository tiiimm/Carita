<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function register_company() {
        $validator = Validator::make(request()->all(), [
            'user_id' => ['required', 'integer', 'max:255', 'unique:philanthropists', 'unique:charities', 'unique:companies'],
            'name' => ['required', 'integer', 'max:255', 'unique:companies']
        ]);
        
        if($validator->fails()) {
            return response(['errors' => $validator->errors()->all()]);
        }

        return \App\Company::create(request()->all());
    }

    public function upload_advertisement(\App\User $user) {
        $user->company->advertisements()->create(request()->all());
        return ['success'=>true];
    }
}
