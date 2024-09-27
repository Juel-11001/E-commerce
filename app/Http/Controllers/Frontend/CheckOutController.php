<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function index(){
        $addresses=UserAddress::where('user_id', Auth::user()->id)->get();
        $shippingMethods=ShippingRule::where('status', 1)->get();
        return view('frontend.pages.checkout', compact('addresses', 'shippingMethods'));
    }
    /**
     * crete checkout address
     */
    public function createAddress(Request $request){
        // dd($request->all());
        $validate = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|email',
            'phone' => 'required|max:200',
            'country' => 'required|max:200',
            'state' => 'required|max:200',
            'city' => 'required|max:200',
            'zip' => 'required|max:200',
            'address' => 'required|max:200',
        ]);
        $address= new UserAddress();
        $address->name=$request->name;
        $address->user_id= Auth::user()->id;
        $address->email=$request->email;
        $address->phone=$request->phone;
        $address->country=$request->country;
        $address->state=$request->state;
        $address->city=$request->city;
        $address->zip=$request->zip;
        $address->address=$request->address;
        $address->save();
        toastr('Address created successfully', 'success', 'Success');
        return redirect()->back();
    }
    /**
     * checkout form submit
     */
    public function checkOutFormSubmit(Request $request){
        $validate = $request->validate([
            'shipping_method_id'=> 'required|integer',
            'shipping_address_id'=> 'required|integer',
        ]);

        $shippingMethod=ShippingRule::findOrFail($request->shipping_method_id);
        // dd($shippingMethod);
        //validation for shipping method
        if($shippingMethod){
            Session()->put('shipping_method',[
                'id' => $shippingMethod->id,
                'name' => $shippingMethod->name,
                'type' =>$shippingMethod->type,
                'cost'=> $shippingMethod->cost
            ]);
        }
        $address=UserAddress::findOrFail($request->shipping_address_id)->toArray();
        if($address){
        Session()->put('shipping_address', $address);
        }
        return response(['status' => 'success', 'redirect_url'=> route('user.payment')]);
    }

}
