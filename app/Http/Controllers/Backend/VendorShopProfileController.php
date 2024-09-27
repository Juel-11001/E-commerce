<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\vendor;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorShopProfileController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile=vendor::where('user_id', Auth::user()->id)->first();
        return view('backend.vendor.shop-profile.index', compact('profile'));
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
        $validated=$request->validate([
            'banner'=>'nullable|image|max:5120',
            'shop_name'=>'required|max:200',
            'phone'=>'required|max:11',
            'email'=>'required|email',
            'address'=>'required|max:200',
            'description'=>'required|max:255',
            'fb_link'=>'nullable|url',
            'tw_link'=>'nullable|url',
            'insta_llink'=>'nullable|url',
        ]);

        $vendor=vendor::where('user_id', Auth::user()->id)->first();
        $bannerPath=$this->updateImage($request, 'banner', 'uploads', $vendor->banner);
        $vendor->banner=empty(!$bannerPath) ? $bannerPath: $vendor->banner;
        $vendor->shop_name=$request->shop_name;
        $vendor->phone=$request->phone;
        $vendor->email=$request->email;
        $vendor->address=$request->address;
        $vendor->description=$request->description;
        $vendor->fb_link=$request->fb_link;
        $vendor->tw_link=$request->tw_link;
        $vendor->insta_link=$request->insta_link;
        $vendor->save();
        toastr('Updated Successfully!', 'success');
        return redirect()->route('vendor.shop-profile.index');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
