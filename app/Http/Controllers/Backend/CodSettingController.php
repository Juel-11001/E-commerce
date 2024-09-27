<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CodSetting;
use Illuminate\Http\Request;

class CodSettingController extends Controller
{
    public function update(Request $request, string $id)
    {
         // dd($request->all());
         $validate = $request->validate([
            'status' => 'required|integer',
        ]);

        CodSetting::updateOrCreate(
            [
                'id'=>$id
            ],
            [
                'status'=>$request->status,
            ]);
            toastr('Settings Updated Successfully!','success', 'Success');
            return redirect()->back();
    }
}
