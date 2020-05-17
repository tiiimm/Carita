<?php

namespace App\Http\Controllers;

use DB;

use App\CompanyAdvertisementPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyAdvertisementPaymentController extends Controller
{
    public function get_payment_record(\App\CompanyAdvertisement $advertisement) {
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
        
        $payments = $advertisement->payment;
        foreach($payments as $payment) {
            if(date('Y', strtotime($payment->inclusive_from)) < request('year') && date('Y', strtotime($payment->inclusive_to)) > request('year')) {
                for ($x = 1; $x <= 12; $x++) {
                    $months[str_pad($x, 2, "0", STR_PAD_LEFT)] = $payment->date_paid;
                }
            }
            else if (date('Y', strtotime($payment->inclusive_from)) == request('year') && date('Y', strtotime($payment->inclusive_to)) > request('year')) {
                $inclusive_from = date('m', strtotime($payment->inclusive_from));
                for ($x = $inclusive_from+1; $x <= 12; $x++) {
                    $months[str_pad($x, 2, "0", STR_PAD_LEFT)] = $payment->date_paid;
                }
            }
            else if (date('Y', strtotime($payment->inclusive_from)) < request('year') && date('Y', strtotime($payment->inclusive_to)) == request('year')) {
                $inclusive_to = date('m', strtotime($payment->inclusive_to));
                for ($x = 1; $x <= $inclusive_to; $x++) {
                    $months[str_pad($x, 2, "0", STR_PAD_LEFT)] = $payment->date_paid;
                }
            }
            else if (date('Y', strtotime($payment->inclusive_from)) == request('year') && date('Y', strtotime($payment->inclusive_to)) == request('year')) {
                $inclusive_from = date('m', strtotime($payment->inclusive_from));
                $inclusive_to = date('m', strtotime($payment->inclusive_to));
                $month = $inclusive_to-$inclusive_from;

                for ($x = 1; $x <= $month; $x++) {
                    $months[str_pad($inclusive_from + $x, 2, "0", STR_PAD_LEFT)] = $payment->date_paid;
                }
            }
        }

        return $months;
    }

    public function get_payment_record_company(Request $request, \App\Company $company) {
        return $company->payment()->where(DB::raw('YEAR(created_at)'), $request['year'])->with('advertisement')->orderBy('date_paid', 'DESC')->get();
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

        $ad = \App\CompanyAdvertisement::find($request['company_advertisement_id']);
        $request['company_id'] = $ad->company_id;
        $ad->payment()->create($request->all());
        $ad->update(['status'=>'Active']);
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
