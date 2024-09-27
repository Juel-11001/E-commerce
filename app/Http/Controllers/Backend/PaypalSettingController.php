<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use Illuminate\Http\Request;

class PaypalSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $validate = $request->validate([
            'status' => 'required|integer',
            'account_mode'=>'required|integer',
            'country_name'=>'required|max:200',
            'currency_name'=>'required|max:200',
            'client_id'=>'required',
            'secret_key'=>'required',
            'currency_rate'=>'required',

        ]);

        PaypalSetting::updateOrCreate(
            [
                'id'=>$id
            ],
            [
                'status'=>$request->status,
                'account_mode'=>$request->account_mode,
                'country_name'=>$request->country_name,
                'currency_name'=>$request->currency_name,
                'client_id'=>$request->client_id,
                'secret_key'=>$request->secret_key,
                'currency_rate'=>$request->currency_rate,
            ]);
            toastr('Settings Updated Successfully!','success', 'Success');
            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
