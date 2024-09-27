@extends('backend.vendor.dashboard.layouts.master')
@section('title')
{{$settings->site_name}} || Dashboard
@endsection
@section('content')
      <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
        <!-- side bar -->
        @include('backend.vendor.dashboard.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content">
            <div class="wsus__dashboard">
              <div class="row">
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="{{route('vendor.orders.index')}}">
                    <i class="fas fa-cart-plus"></i>
                    <p>today's order</p>
                    <h4 class="badge">{{$todaysOrder}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="{{route('vendor.orders.index')}}">
                    <i class="fas fa-cart-plus"></i>
                    <p>td's pending order</p>
                    <h4 class="badge">{{$todaysPendingOrder}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="{{route('vendor.orders.index')}}">
                    <i class="fas fa-cart-plus"></i>
                    <p>total order</p>
                    <h4 class="badge">{{$totalOrder}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="{{route('vendor.orders.index')}}">
                    <i class="fas fa-cart-plus"></i>
                    <p>pending orders</p>
                    <h4 class="badge">{{$totalPendingOrder}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="{{route('vendor.orders.index')}}">
                    <i class="fas fa-cart-plus"></i>
                    <p>Completed orders</p>
                    <h4 class="badge">{{$totalCompletedOrder}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="{{route('vendor.products.index')}}">
                    <i class="fas fa-cart-plus"></i>
                    <p>total products</p>
                    <h4 class="badge">{{$totalProducts}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="javascript:;">
                    <i class="fas fa-cart-plus"></i>
                    <p>todays earnings</p>
                    <h4 class="badge">{{$settings->currency_icon}}{{$todaysEarning}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="javascript:;">
                    <i class="fas fa-cart-plus"></i>
                    <p>this month earnings</p>
                    <h4 class="badge">{{$settings->currency_icon}}{{$monthEarning}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="javascript:;">
                    <i class="fas fa-cart-plus"></i>
                    <p>this year earnings</p>
                    <h4 class="badge">{{$settings->currency_icon}}{{$yearEarning}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="javascript:;">
                    <i class="fas fa-cart-plus"></i>
                    <p>total earnings</p>
                    <h4 class="badge">{{$settings->currency_icon}}{{$totalEarning}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item sky" href="{{route('vendor.reviews.index')}}">
                    <i class="fas fa-star"></i>
                    <p>review</p>
                    <h4 class="badge">{{$reviews}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item blue" href="javascript:void(0)">
                    <i class="far fa-heart"></i>
                    <p>wishlist</p>
                    <h4 class="badge">{{$wishlist}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item orange" href="{{route('vendor.profile')}}">
                    <i class="fas fa-user-shield"></i>
                    <p>profile</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item purple" href="{{route('vendor.shop-profile.index')}}">
                    <i class="fal fa-map-marker-alt"></i>
                    <p>address</p>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->

@endsection
