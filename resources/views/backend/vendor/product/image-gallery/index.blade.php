@extends('backend.vendor.dashboard.layouts.master')
@section('title')
{{$settings->site_name}} || Product Image Gallery
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
            <div class="d-flex justify-content-between align-items-center">
                <h3><i class="far fa-user"></i> Product : {{$product->name}}</h3>
                <div class="card-header-action">
                    <a href="{{route('vendor.products.index')}}" class="btn btn-primary mb-2"><i class="fas fa-caret-left"></i>  Back</a>
                </div>
            </div>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
               <div class="card-body">
                <form action="{{route('vendor.products-image-gallery.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Image <code> (Multi Image Supported!)</code></label>
                        <input type="file" name="image[]" class="form-control" multiple>
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Upload</button>
                </form>
              </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <div class="d-flex justify-content-between align-items-center">
                <h3><i class="far fa-images"></i> Product Images Gallery</h3>

            </div>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                {{-- <h4>basic information</h4> --}}
                {{ $dataTable->table() }}
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
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

