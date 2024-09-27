<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\vendor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    public function index(){
        $sliders=Cache::rememberForever('sliders', function () {
            return Slider::where('status', 1)->orderBy('serial','asc')->get();
        });
        $sliders=Slider::where('status', 1)->orderBy('serial','asc')->get();
        $flashSaleDate=FlashSale::first();

        // $flashSaleItems=FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
        $flashSaleItems=FlashSaleItem::where('show_at_home', 1)->where('status',1)->pluck('product_id')->toArray();

        $popularCategory=HomePageSetting::where('key', 'popular_category_section')->first();
        $brands=Brand::where('status', 1)->where('is_featured', 1)->get();
        $typeBaseProducts=$this->getTypeBaseProduct();
        $categoryProductSliderSectionOne=HomePageSetting::where('key', 'product_slider_section_one')->first();
        $categoryProductSliderSectionTwo=HomePageSetting::where('key', 'product_slider_section_two')->first();
        $categoryProductSliderSectionThree=HomePageSetting::where('key', 'product_slider_section_three')->first();
        //ad feature banner section
        $home_banner_one=Advertisement::where('key', 'homepage_banner_section_one')->first();
        $home_banner_one=json_decode($home_banner_one->value);
        $home_banner_two=Advertisement::where('key', 'homepage_banner_section_two')->first();
        $home_banner_two=json_decode($home_banner_two?->value);
        $home_banner_three=Advertisement::where('key', 'homepage_banner_section_three')->first();
        $home_banner_three=json_decode($home_banner_three?->value);
        $home_banner_four=Advertisement::where('key', 'homepage_banner_section_four')->first();
        $home_banner_four=json_decode($home_banner_four?->value);
        $recentBlog=Blog::with('category', 'user')->where('status', 1)->orderBy('id', 'DESC')->take(6)->get();
        return view('frontend.home.index', compact('sliders','flashSaleDate',
            'flashSaleItems','popularCategory','brands','typeBaseProducts','categoryProductSliderSectionOne','categoryProductSliderSectionTwo',
            'categoryProductSliderSectionThree', 'home_banner_one', 'home_banner_two', 'home_banner_three', 'home_banner_four', 'recentBlog'
        ));
    }

    /**
     * get type base product
     */
    public function getTypeBaseProduct()
    {
        $typeBaseProducts=[];
        $typeBaseProducts['new_arrival']=Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['category', 'variants', 'productImageGalleries'])->where(['product_type' => 'new_arrival', 'status'=>1, 'is_approved'=>1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProducts['featured_product']=Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['category', 'variants', 'productImageGalleries'])->where(['product_type' => 'featured_product', 'status'=>1, 'is_approved'=>1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProducts['top_product']=Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['category', 'variants', 'productImageGalleries'])->where(['product_type' => 'top_product', 'status'=>1, 'is_approved'=>1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProducts['best_product']=Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['category', 'variants', 'productImageGalleries'])->where(['product_type' => 'best_product', 'status'=>1, 'is_approved'=>1])->orderBy('id', 'DESC')->take(8)->get();
        return $typeBaseProducts;
    }

    /**
     * vendor page
     */
    public function vendorPage()
    {
        $vendors=vendor::where('status', 1)->paginate(10);
        return view('frontend.pages.vendor', compact('vendors'));
    }
    /**
     * vendor product page
     */
    public function vendorProductPage(string $id)
    {
        $products=Product::where(['status'=>1,'is_approved'=>1, 'vendor_id'=> $id])->orderBy('id', 'DESC')->paginate(12);
        $categories=Category::where(['status'=>1])->get();
        $brands=Brand::where('status',1)->get();
        $prod_banner=Advertisement::where('key', 'productpage_banner_section')->first();
        $prod_banner=json_decode($prod_banner?->value);
        $vendor = Vendor::findOrFail($id);
        return view('frontend.pages.vendor-product-details', compact('products','categories', 'brands', 'prod_banner', 'vendor'));
    }
    public function showProductModel(string $id)
    {
        $product=Product::findOrFail($id);
        $content=view('frontend.layouts.model-view', compact('product'))->render();
        return Response::make($content, 200,['Content-Type' => 'text/html']);
    }
}

