@extends('frontend.layouts.master')
@section('title')
    {{$settings->site_name}} || Vendor
@endsection
@section('content')
<!--============================
BREADCRUMB START
==============================-->
<section id="wsus__breadcrumb">
<div class="wsus_breadcrumb_overlay">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>Vendors</h4>
                <ul>
                    <li><a href="{{route('fronted.home')}}">home</a></li>
                    <li><a href="#">Vendors</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
</section>
<!--============================
BREADCRUMB END
==============================-->


<!--============================
    VENDORS START
==============================-->
<section id="wsus__product_page" class="wsus__vendors">
    <div class="container">
        <div class="row">
            {{-- <div class="col-xl-3 col-lg-4">
                <div class="wsus__sidebar_filter">
                    <p>filter</p>
                    <span class="wsus__filter_icon">
                        <i class="far fa-minus" id="minus"></i>
                        <i class="far fa-plus" id="plus"></i>
                    </span>
                </div>
                <div class="wsus__product_sidebar wsus__vendor_sidebar" id="sticky_sidebar">
                    <form>
                        <input type="text" placeholder="Search...">
                        <button class="common_btn" type="submit"><i class="far fa-search"></i></button>
                    </form>
                    <div class="wsus__vendor_sidebar_select">
                        <h4>filter by category</h4>
                        <select class="select_2" name="state">
                            <option>choose category</option>
                            <option>men's</option>
                            <option>wemen's</option>
                            <option>kid's</option>
                            <option>electronics</option>
                            <option>electrick</option>
                        </select>
                    </div>
                    <div class="wsus__vendor_sidebar_select">
                        <h4>filter by location</h4>
                        <select class="select_2" name="state">
                            <option>choose location</option>
                            <option>short by rating</option>
                            <option>short by latest</option>
                            <option>low to high </option>
                            <option>high to low</option>
                        </select>
                    </div>
                    <div class="wsus__vendor_sidebar_select">
                        <select class="select_2" name="state">
                            <option>choose state</option>
                            <option>korea</option>
                            <option>japan</option>
                            <option>china</option>
                            <option>singapore</option>
                            <option>thailand</option>
                        </select>
                    </div>
                    <div class="wsus__vendor_sidebar_select">
                        <select class="select_2" name="state">
                            <option>search by city</option>
                            <option>korea</option>
                            <option>japan</option>
                            <option>china</option>
                            <option>singapore</option>
                            <option>thailand</option>
                        </select>
                    </div>
                </div>
            </div> --}}
            <div class="">
                <div class="row">
                    @foreach ($vendors as $vendor)
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__vendor_single">
                            <img src="{{asset($vendor->banner)}}" alt="vendor" class="img-fluid w-100">
                            <div class="wsus__vendor_text">
                                <div class="wsus__vendor_text_center">
                                    <h4>{{$vendor->shop_name}}</h4>
                                    <p class="wsus__vendor_rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </p>
                                    <a href="callto:{{$vendor->phone}}"><i class="far fa-phone-alt"></i>
                                        {{$vendor->phone}}</a>
                                    <a href="mailto:{{$vendor->email}}"><i class="fal fa-envelope"></i>
                                        {{$vendor->email}}</a>
                                    <a href="{{route('vendor.products', $vendor->id)}}" class="common_btn">visit store</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-12">
                <section id="pagination">
                    <div class="mt-5">
                    @if ($vendors->hasPages())
                        {{ $vendors->links() }}
                    @endif
                </div>
                </section>
            </div>
        </div>
    </div>
</section>
<!--============================
    VENDORS END
==============================-->
@endsection
