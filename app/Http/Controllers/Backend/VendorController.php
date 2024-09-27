<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function dashboard(){
        $todaysOrder=Order::whereDate('created_at', Carbon::today())->whereHas('orderProducts', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();
        $todaysPendingOrder=Order::whereDate('created_at', Carbon::today())->where('order_status', 'pending')->whereHas('orderProducts', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();
        $totalOrder=Order::whereHas('orderProducts', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();
        $totalPendingOrder=Order::where('order_status', 'pending')->whereHas('orderProducts', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();
        $totalCompletedOrder=Order::where('order_status', 'delivered')->whereHas('orderProducts', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();
        $totalProducts=Product::where('vendor_id', Auth::user()->vendor->id)->count();
        $todaysEarning=Order::where('order_status', 'delivered')->where('payment_status', 1)->whereDate('created_at', Carbon::today())->wherehas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->sum('sub_total');
        $monthEarning=Order::where('order_status', 'delivered')->where('payment_status', 1)->whereMonth('created_at', Carbon::now()->month)->wherehas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->sum('sub_total');
        $yearEarning=Order::where('order_status', 'delivered')->where('payment_status', 1)->whereYear('created_at', Carbon::now()->year)->wherehas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->sum('sub_total');
        $totalEarning=Order::where('order_status', 'delivered')->wherehas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->sum('sub_total');
        $reviews=ProductReview::whereHas('product', function ($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();
        // $reviews=ProductReview::where('vendor_id', Auth::user()->vendor->id)->count();
        $wishlist=WishList::where('user_id', Auth::user()->vendor->id)->count();
        return view('backend.vendor.dashboard.dashboard', compact('todaysOrder', 'todaysPendingOrder', 'totalOrder', 'totalPendingOrder', 'totalCompletedOrder', 'totalProducts', 'reviews', 'wishlist', 'todaysEarning', 'monthEarning','yearEarning','totalEarning'));
    }
}
