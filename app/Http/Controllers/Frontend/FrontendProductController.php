<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontendProductController extends Controller
{
    /**
     * Display Products
     */
    public function productsIndex(Request $request)
    {
        if($request->has('category')){
            $category=Category::where('slug', $request->category)->firstOrFail();
            // dd($category);
            $products=Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['category', 'variants', 'productImageGalleries'])->where([
                'category_id'=>$category->id,
                'status'=>1,
                'is_approved'=>1
            ])->when($request->has('range'), function ($query) use ($request) {
                $price=explode(';', $request->range);
                $form=$price[0];
                $to=$price[1];
                return $query->where('price', '>=', $form)->where('price', '<=', $to);
                // return $query->whereBetween('price', [$form, $to]);
            })->paginate(12);
        }else if($request->has('sub_category')){
            $category=SubCategory::where('slug', $request->sub_category)->firstOrFail();
            // dd($category);
            $products=Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['category', 'variants', 'productImageGalleries'])->where([
                'sub_category_id'=>$category->id,
                'status'=>1,
                'is_approved'=>1
            ])->when($request->has('range'), function ($query) use ($request) {
                $price=explode(';', $request->range);
                $form=$price[0];
                $to=$price[1];
                return $query->where('price', '>=', $form)->where('price', '<=', $to);
                // return $query->whereBetween('price', [$form, $to]);
            })->paginate(12);
        }else if($request->has('child_category')){
            $category=ChildCategory::where('slug', $request->child_category)->firstOrFail();
            // dd($category);
            $products=Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['category', 'variants', 'productImageGalleries'])->where([
                'child_category_id'=>$category->id,
                'status'=>1,
                'is_approved'=>1
            ])->when($request->has('range'), function ($query) use ($request) {
                $price=explode(';', $request->range);
                $form=$price[0];
                $to=$price[1];
                return $query->where('price', '>=', $form)->where('price', '<=', $to);
                // return $query->whereBetween('price', [$form, $to]);
            })->paginate(12);
        }else if(request()->has('brand')){
            $brand=Brand::where('slug', request()->brand)->firstOrFail();
            $products=Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['category', 'variants', 'productImageGalleries'])->where([
                'brand_id'=>$brand->id,
                'status'=>1,
                'is_approved'=>1
            ])->when($request->has('range'), function ($query) use ($request) {
                $price=explode(';', $request->range);
                $form=$price[0];
                $to=$price[1];
                return $query->where('price', '>=', $form)->where('price', '<=', $to);
                // return $query->whereBetween('price', [$form, $to]);
            })->paginate(12);
        }else if($request->has('search')){
            $products=Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['category', 'variants', 'productImageGalleries'])->where([
                'status'=>1,
                'is_approved'=>1
            ])->where(function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('long_description', 'like', '%'.$request->search.'%')
                ->orWhereHas('category', function ($query) use ($request) {
                    $query->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('long_description', 'like', '%'.$request->search.'%');
                });
            })->when($request->has('range'), function ($query) use ($request) {
                $price=explode(';', $request->range);
                $form=$price[0];
                $to=$price[1];
                return $query->where('price', '>=', $form)->where('price', '<=', $to);
            })->paginate(12);
        }else{
            $products=Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['category', 'variants', 'productImageGalleries'])->where([
                'status'=>1,
                'is_approved'=>1
            ])->when($request->has('range'), function ($query) use ($request) {
                $price=explode(';', $request->range);
                $form=$price[0];
                $to=$price[1];
                return $query->where('price', '>=', $form)->where('price', '<=', $to);
                // return $query->whereBetween('price', [$form, $to]);
            })->orderBy('id', 'DESC')->paginate(12);
        }
        $categories=Category::where(['status'=>1])->get();
        $brands=Brand::where('status',1)->get();
        $prod_banner=Advertisement::where('key', 'productpage_banner_section')->first();
        $prod_banner=json_decode($prod_banner?->value);
        return view('frontend.pages.product', compact('products','categories', 'brands', 'prod_banner'));
    }
    /**
     * Display Product Detail
     */
    public function productDetail(string $slug)
    {

        $product=Product::with(['vendor', 'category', 'productImageGalleries', 'variants', 'brand'])->where('slug',$slug)->where('status', 1)->first();
        $reviews=ProductReview::where('product_id', $product?->id)->where('status', 1)->paginate(10);
        return view('frontend.pages.product-detail', compact('product', 'reviews'));

    }
    /**
     * change product list view
     */
    public function changeListView(Request $request)
    {
        Session::put('product_list_style', $request->style);
    }
}
