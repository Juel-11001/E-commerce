@extends('backend.vendor.dashboard.layouts.master')
@section('title')
    {{ $settings->site_name }} || Withdraw Request
@endsection
@section('content')
    <!--=============================
        CREATE START
      ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('backend.vendor.dashboard.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Withdraw Request</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="row">
                                <div class="wsus__dash_pro_area col-md-6 mr-1">

                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Withdraw Method</th>
                                                    <td>{{$requestInfo->method}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Withdraw Charge</th>
                                                    <td>{{($requestInfo->withdraw_charge / $requestInfo->total_amount) * 100}}%</td>
                                                </tr>
                                                <tr>
                                                    <th>Withdraw Charge Amount</th>
                                                    <td>{{$settings->currency_icon}}{{$requestInfo->withdraw_charge}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Amount</th>
                                                    <td>{{$settings->currency_icon}}{{$requestInfo->total_amount}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Withdraw Amount</th>
                                                    <td>{{$settings->currency_icon}}{{$requestInfo->withdraw_amount}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>
                                                    @if ($requestInfo->status == 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif ($requestInfo->status == 'paid')
                                                        <span class="badge bg-success">Paid</span>
                                                    @else
                                                        <span class="badge bg-danger">Declined</span>
                                                    @endif
                                                </td>
                                                </tr>
                                                <tr>
                                                    <th>Account Information</th>
                                                    <td>{!! $requestInfo->account_info!!}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        CREATE END
      ==============================-->
@endsection

