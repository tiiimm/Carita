<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function set_up_company(\App\User $user) {
        $validator = Validator::make(request()->all(), [
            'role' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'integer', 'unique:users'],
            'address' => ['required', 'string', 'max:225'],
            'name' => ['required', 'string', 'max:225', 'unique:companies'],
            'logo' => ['required', 'string', 'max:225'],
        ]);
        
        if($validator->fails()) {
            return response(['errors' => $validator->errors()->all()]);
        }
        
        $user->company()->create(request()->all());
        $user->update([
            'role' => request('role'),
            'contact_number' => request('contact_number'),
            'address' => request('address')
        ]);
        return $user->company;
    }

    public function approve_company(Company $company) {
        $company->update(['status'=>'Approved']);
        return $company;
    }

    public function reject_company(Company $company) {
        $company->update(['status'=>'Rejected']);
        return $company;
    }

    public function approve_advertisement(\App\CompanyAdvertisement $advertisement) {
        $advertisement->update(['status'=>'Approved']);
        return $advertisement;
    }

    public function reject_advertisement(\App\CompanyAdvertisement $advertisement) {
        $advertisement->update(['status'=>'Rejected']);
        return $advertisement;
    }

    public function upload_advertisement(\App\User $user) {
        $ad = $user->company->advertisements()->create(request()->all());
        $ad->update(['billing_date'=>$ad->created_at]);
        return ['success'=>true];
    }

    public function get_own_advertisements(Company $company) {
        $ads = $company->advertisements()->with('company', 'charity')->get();
        foreach($ads as $ad) {
            $ad['active_until'] = $ad->payment()->latest()->first()['inclusive_to'];
            if ($ad['active_until'] < date('Y-m-d'))
                $ad['status'] = 'Inactive';
        }
        return $ads;
    }

    public function get_advertisements() {
        $ads = \App\CompanyAdvertisement::with('company', 'charity')->get();
        foreach($ads as $ad) {
            $ad['active_until'] = $ad->payment()->latest()->first()['inclusive_to'];
            if ($ad['active_until'] < date('Y-m-d'))
                $ad['status'] = 'Inactive';
        }
        return $ads;
    }

    public function get_have_charity_advertisements() {
        $ads = \App\CompanyAdvertisement::where('charity_id', '<>', null)->where('status', 'Active')->with('company', 'charity')->get();
        foreach($ads as $ad) {
            $ad['active_until'] = $ad->payment()->latest()->first()['inclusive_to'];
            if ($ad['active_until'] < date('Y-m-d'))
                $ad['status'] = 'Inactive';
        }
        return $ads->where('status', 'Active');
    }

    public function show_advertisement(\App\CompanyAdvertisement $advertisement) {
        $advertisement->company;
        return $advertisement;
    }

    public function get_active_advertisements() {
        $ads = \App\CompanyAdvertisement::with('company', 'charity')->where('status', 'Active')->get();
        foreach($ads as $ad) {
            $ad['active_until'] = $ad->payment()->latest()->first()['inclusive_to'];
            if ($ad['active_until'] < date('Y-m-d'))
                $ad['status'] = 'Inactive';
        }
        return $ads->where('status', 'Active');
    }

    public function get_companies(Request $request) {
        if ($request->user()->role == "Administrator")
            return \App\Company::with('user', 'charity')->get();
        else
            return \App\Company::where('status', 'Approved')->with('charity', 'user')->get();
        // return \App\Company::where('status', '<>', 'Inactive')->get();
    }

    // public function approve_company() {
    //     \App\Company::find(request('id'))->update(['status'=>'Active']);
    // }

    public function delete_company() {
        \App\Company::find(request('id'))->update(['status'=>'Inactive']);
    }

    // public function approve_advertisement() {
    //     \App\CompanyAdvertisement::find(request('id'))->update(['status'=>'Active']);
    // }

    public function delete_advertisement() {
        \App\CompanyAdvertisement::find(request('id'))->update(['status'=>'Inactive']);
    }

    public function get_views() {
        return \App\WatchLog::where('advertisable_id', request('id'))->get();
    }
}
