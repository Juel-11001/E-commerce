<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\vendor;
use App\Models\VendorCondition;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserVendorRequestController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $content=VendorCondition::first();
        return view('frontend.dashboard.vendor-request.index', compact('content'));
    }
    public function create(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'shop_banner' => 'required|image|max:5120',
            'shop_name' => 'required|max:200',
            'shop_email' => 'required|email',
            'shop_phone' => 'required|max:200',
            'shop_address' => 'required',
            'shop_about' =>    'required',
        ]);
        if(Auth::user()->role==='vendor'){
            return redirect()->back();
        }
        $imagePath=$this->uploadImage($request, 'shop_banner', 'uploads/vendor_shop');
        $vendor= new vendor();

        $vendor->banner=$imagePath;
        $vendor->phone=$request->shop_phone;
        $vendor->email=$request->shop_email;
        $vendor->shop_name=$request->shop_name;
        $vendor->address=$request->shop_address;
        $vendor->description=$request->shop_about;
        $vendor->user_id=Auth::user()->id;
        $vendor->status=0;
        $vendor->save();
        toastr()->success('Became Vendor Request Send Successfully! Wait for Approval', 'Success');
        return redirect()->back();
    }
}
