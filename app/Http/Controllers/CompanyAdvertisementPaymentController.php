<?php

namespace App\Http\Controllers;

use App\CompanyAdvertisementPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyAdvertisementPaymentController extends Controller
{
    public function get_payment_record(\App\CompanyAdvertisement $advertisement) {
        return $advertisement->payment;
    }

    public function get_payment_record_company(Request $request) {
        return $request->user()->company->payment;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'company_advertisement_id' => ['required', 'integer', 'max:255'],
            'inclusive_from' => ['required', 'date', 'max:225'],
            'inclusive_to' => ['required', 'date', 'max:225'],
            'date_paid' => ['required', 'date', 'max:225'],
            'amount' => ['required', 'max:225'],
        ]);

        $payment = CompanyAdvertisementPayment::create($request->all());
        $payment->advertisement()->update(['status'=>'Active']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyAdvertisementPayment  $companyAdvertisementPayment
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyAdvertisementPayment $companyAdvertisementPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanyAdvertisementPayment  $companyAdvertisementPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyAdvertisementPayment $companyAdvertisementPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyAdvertisementPayment  $companyAdvertisementPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyAdvertisementPayment $companyAdvertisementPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyAdvertisementPayment  $companyAdvertisementPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyAdvertisementPayment $companyAdvertisementPayment)
    {
        //
    }
}
