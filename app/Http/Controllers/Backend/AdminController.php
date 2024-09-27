<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\NewsletterSubscriber;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function dashboard(){
        $todaysOrders=Order::whereDate('created_at', Carbon::today())->count();
        $todaysPendingOrders=Order::whereDate('created_at', Carbon::today())->where('order_status', 'pending')->count();
        $totalOrders=Order::count();
        $totalPendingOrders=Order::where('order_status', 'pending')->count();
        $totalCancleOrders=Order::where('order_status', 'canceled')->count();
        $totalCompletedOrders=Order::where('order_status', 'delivered')->count();
        $todaysEarning=Order::where('order_status','!=', 'canceled')->where('payment_status', 1)->whereDate('created_at', Carbon::today())->sum('sub_total');
        $monthEarning=Order::where('order_status','!=', 'canceled')->where('payment_status', 1)->whereMonth('created_at', Carbon::today())->sum('sub_total');
        $yearEarning=Order::where('order_status','!=', 'canceled')->where('payment_status', 1)->whereYear('created_at', Carbon::today())->sum('sub_total');
        $totalReview=ProductReview::count();
        $totalBrand=Brand::count();
        $totalCategories=Category::count();
        $totalBlog=Blog::count();
        $totalSubscribers=NewsletterSubscriber::count();
        $totalVendors=User::where('role', 'vendor')->count();
        $totalUsers=User::where('role', 'user')->count();
        return view('backend.admin.dashboard', compact('todaysOrders', 'todaysPendingOrders', 'totalOrders', 'totalPendingOrders', 'totalCancleOrders','totalCompletedOrders','todaysEarning','monthEarning','yearEarning', 'totalReview','totalBrand','totalCategories','totalBlog','totalSubscribers','totalVendors','totalUsers'));
    }
    public function login(){
        return view('backend.admin.auth.login');
    }
}
