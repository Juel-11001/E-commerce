@extends('backend.admin.layouts.master')
@section('content')
     <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Vendor Profile</h1>
            {{-- <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Components</a></div>
              <div class="breadcrumb-item">Table</div>
            </div> --}}
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Update Vendor Profile</h4>

                  </div>
                   <div class="card-body">
                    <form action="{{route('admin.vendor-profile.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                    <div class="form-group col-md-6">
                        <label>Shop Name</label>
                        <input type="text" class="form-control" name="shop_name" value="{{$vProfile->shop_name}}">
                        </div>
                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{$vProfile->phone}}">
                      </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="{{$vProfile->email}}">
                          </div>
                          <div class="form-group col-md-6">
                              <label>Address</label>
                              <input type="text" class="form-control" name="address" value="{{$vProfile->address}}">
                            </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="summernote" name="description">{{$vProfile->description}}</textarea>
                      </div>
                      <div class="row">
                    <div class="form-group col-md-6">
                        <label>Facebook</label>
                        <input type="text" class="form-control" name="fb_link" value="{{$vProfile->fb_link}}">
                      </div>
                    <div class="form-group col-md-6">
                        <label>Twiter</label>
                        <input type="text" class="form-control" name="tw_link" value="{{$vProfile->tw_link}}">
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6">
                        <label>Instagram</label>
                        <input type="text" class="form-control" name="insta_link" value="{{$vProfile->insta_link}}">
                      </div>
                    <div class="form-group col-md-6">
                        <label>Banner</label>
                        <input type="file" class="form-control" name="banner">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-5">Preview</label>
                        <img src="{{asset($vProfile->banner)}}"  alt="" width="120px">
                      </div>
                      <button type="submit" class="btn btn-primary mt-3" >Update</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>
        </section>

@endsection
