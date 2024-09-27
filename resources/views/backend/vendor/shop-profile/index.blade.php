@extends('backend.vendor.dashboard.layouts.master')
@section('title')
{{$settings->site_name}} || Shop Profile
@endsection
@section('content')
      <!--=============================
    DASHBOARD START
  ==============================-->
   <section id="wsus__dashboard">
    <div class="container-fluid">
      @include('backend.vendor.dashboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i>Shop profile</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                {{-- <h4>basic information</h4> --}}

                    <form action="{{route('vendor.shop-profile.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                    <div class="form-group col-md-6 wsus__input">
                        <label>Shop Name</label>
                        <input type="text" class="form-control" name="shop_name" value="{{$profile->shop_name}}">
                      </div>
                    <div class="form-group col-md-6 wsus__input">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{$profile->phone}}">
                      </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 wsus__input">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="{{$profile->email}}">
                          </div>
                        <div class="form-group wsus__input col-md-6">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" value="{{$profile->address}}">
                        </div>
                    </div>
                    <div class="form-group wsus_input">
                        <label>Description</label>
                        <textarea class="summernote" name="description">{{$profile->description}}</textarea>
                      </div>
                      <div class="row">
                    <div class="form-group wsus__input col-md-6">
                        <label>Facebook</label>
                        <input type="text" class="form-control" name="fb_link" value="{{$profile->fb_link}}">
                      </div>
                    <div class="form-group wsus__input col-md-6">
                        <label>Twiter</label>
                        <input type="text" class="form-control" name="tw_link" value="{{$profile->tw_link}}">
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group wsus__input col-md-6">
                        <label>Instagram</label>
                        <input type="text" class="form-control" name="insta_link" value="{{$profile->insta_link}}">
                      </div>
                    <div class="form-group wsus__input col-md-6">
                        <label>Banner</label>
                        <input type="file" class="form-control" name="banner">
                      </div>
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="mr-preview">Preview</label>
                        <img src="{{asset($profile->banner)}}"  alt="" width="120px">
                      </div>
                      <button type="submit" class="btn btn-primary mt-5" >Update</button>
                    </form>
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


