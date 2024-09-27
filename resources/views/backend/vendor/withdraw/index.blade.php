@extends('backend.vendor.dashboard.layouts.master')
@section('title')
{{$settings->site_name}} || Withdraw
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
                <h3><i class="far fa-user"></i> Withdraw</h3>

                <div class="card-button">
                    <a href="{{route('vendor.withdraw.create')}}" class="btn btn-primary  mb-3"><i class="fas fa-plus"></i> Create Request</a>
                </div>
            </div>
            <div class="wsus__dashboard">
              <div class="row">
                <div class=" col-md-4">
                    <a class="wsus__dashboard_item red" href="javasscript:;">
                      <i class="fas fa-cart-plus"></i>
                      <p>Currenct Blance</p>
                      <h4 class="badge">{{$settings->currency_icon}}{{$currenctBalance}}</h4>
                    </a>
                  </div>
                <div class=" col-md-4">
                    <a class="wsus__dashboard_item red" href="javasscript:;">
                      <i class="fas fa-cart-plus"></i>
                      <p>Pending Blance</p>
                      <h4 class="badge">{{$settings->currency_icon}}{{$pendingWithdraw}}</h4>
                    </a>
                  </div>
                <div class=" col-md-4">
                    <a class="wsus__dashboard_item red" href="javasscript:;">
                      <i class="fas fa-cart-plus"></i>
                      <p>Total Withdraw</p>
                      <h4 class="badge">{{$settings->currency_icon}}{{$totalWithdraw}}</h4>
                    </a>
                  </div>
                </div>
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
