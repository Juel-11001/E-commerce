@extends('frontend.dashboard.layouts.master')
@section('title')
{{$settings->site_name}} || Becam A Vendor Today
@endsection
@section('content')
      <!--=============================
    DASHBOARD START
  ==============================-->
   <section id="wsus__dashboard">
    <div class="container-fluid">
      @include('frontend.dashboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <div class="d-flex justify-content-between align-items-center">
                <h3><i class="far fa-user"></i>Vendor Request</h3>
            </div>
            <div class="wsus__dashboard_profile width">
              <div class="wsus__dash_pro_area pading">
                {!!@$content->content !!}
              </div>
            </div>
            <div class="wsus__dashboard_profile width mt-4">
              <div class="wsus__dash_pro_area pading">
                <form action="{{route('user.vendor-request.create')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-xl-12 col-md-12">
                      <div class="wsus__dash_pro_single">
                        <i class="fas fa-image" aria-hidden="true"></i>
                        <input type="file" placeholder="Shop Banner Image" name="shop_banner">
                      </div>
                    </div>

                    <div class="col-xl-12 col-md-12">
                      <div class="wsus__dash_pro_single">
                        <i class="fas fa-user-tie" aria-hidden="true"></i>
                        <input type="text" name="shop_name" placeholder="Shop Name" >
                      </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                      <div class="wsus__dash_pro_single">
                        <i class="fal fa-envelope-open" aria-hidden="true"></i>
                        <input type="email" name="shop_email" placeholder="Shop@gmail.com">
                      </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                      <div class="wsus__dash_pro_single">
                        <i class="fas fa-phone" aria-hidden="true"></i>
                        <input type="text" name="shop_phone" placeholder="Shop Phone">
                      </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                      <div class="wsus__dash_pro_single">

                        <i class="fas fa-address-card"  aria-hidden="true"></i>
                        <input type="text" name="shop_address" placeholder="Shop Address">
                      </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                      <div class="wsus__dash_pro_single">
                        <textarea name="shop_about" id="" cols="30" rows="5" placeholder="About Shop"></textarea>
                      </div>
                    </div>

                  </div>
                  <button class="common_btn" type="submit">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD END
  ==============================-->
@endsection
