<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses=UserAddress::where('user_id',Auth::user()->id)->get();
        return view('frontend.dashboard.address.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.dashboard.address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validate = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|max:200|email',
            'phone' => 'required|max:200',
            'country' => 'required|max:200',
            'state' => 'required|max:200',
            'city' => 'required|max:200',
            'zip' => 'required|max:200',
            'address' => 'required',
        ]);

        $user= new UserAddress();
        $user->name=$request->name;
        $user->user_id= Auth::user()->id;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->country=$request->country;
        $user->state=$request->state;
        $user->city=$request->city;
        $user->zip=$request->zip;
        $user->address=$request->address;
        $user->save();
        toastr('Address Created Successfully','success', 'Success');
        return redirect()->route('user.address.index');
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
        $address=UserAddress::find($id);
        return view('frontend.dashboard.address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $validate = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|max:200|email',
            'phone' => 'required|max:200',
            'country' => 'required|max:200',
            'state' => 'required|max:200',
            'city' => 'required|max:200',
            'zip' => 'required|max:200',
            'address' => 'required',
        ]);

        $user= UserAddress::find($id);
        $user->name=$request->name;
        $user->user_id= Auth::user()->id;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->country=$request->country;
        $user->state=$request->state;
        $user->city=$request->city;
        $user->zip=$request->zip;
        $user->address=$request->address;
        $user->save();
        toastr('Address  Successfully','success', 'Success');
        return redirect()->route('user.address.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address=UserAddress::find($id);
        $address->delete();
        return response(['status'=>'success', 'message'=>'Deleted Successfully!']);
    }
}
