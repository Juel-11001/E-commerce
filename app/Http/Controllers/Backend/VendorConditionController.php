<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\VendorCondition;
use Illuminate\Http\Request;

class VendorConditionController extends Controller
{
    public function index()
    {
        $content=VendorCondition::first();
        return view('backend.admin.vendor-condition.index', compact('content'));
    }

    public function update(Request $request)
    {
        $validation=$request->validate([
            'content' => 'required',
        ]);
        VendorCondition::updateOrCreate(
            [
                'id'=>1
            ],
            [
                'content' => $request->content
            ]
        );
        toastr('Vendor Condition Updated Successfully', 'success', 'Success');
        // return redirect()->route('admin.vendor-condition.index');
        return redirect()->back();
    }
}
