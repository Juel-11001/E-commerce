<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function index()
    {
        $wishlistProduct=WishList::with('product')->where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('frontend.pages.wishlist', compact('wishlistProduct'));
    }
    public function addProductToWishList(Request $request)
    {
        if(!Auth::check()){
            return response(['status' => 'error', 'message' => 'Please Login First! add product to Wishlist']);
        }
        $wishlistCount=WishList::where(['product_id'=>$request->id,'user_id'=>Auth::user()->id])->count();
        if($wishlistCount>0){
            return response(['status' => 'error', 'message' => 'Product Already Added To Wishlist']);
        }
        $wishlist=new WishList();
        $wishlist->product_id=$request->id;
        $wishlist->user_id=Auth::user()->id;
        $wishlist->save();
        $count=WishList::where(['user_id'=>Auth::user()->id])->count();
        return response(['status' => 'success', 'message' => 'Product Added To Wishlist', 'count'=>$count]);
    }
    public function destroy(string $id)
    {
        $wishlistproducts = WishList::where('id', $id)->firstOrFail();

        if ($wishlistproducts->user_id !== Auth::user()->id) {
            return redirect()->back()->withErrors('You do not have permission to delete this item.');
        }

        $wishlistproducts->delete();

        toastr()->success('Deleted Successfully!', 'Success');

        return redirect()->back();
    }
}
