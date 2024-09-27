<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StripeSetting;
use Illuminate\Http\Request;

class StripeSettingController extends Controller
{
    /**
     * Display a listing of the resource.
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

        StripeSetting::updateOrCreate(
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
}
