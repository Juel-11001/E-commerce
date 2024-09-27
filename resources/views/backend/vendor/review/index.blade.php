@extends('backend.vendor.dashboard.layouts.master')
@section('title')
{{$settings->site_name}} || Reviews
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
                <h3><i class="far fa-user"></i> Reviews</h3>
            </div>
            <div class="wsus__dashboard_profile width">
              <div class="wsus__dash_pro_area pading">
                {{ $dataTable->table() }}
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
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

