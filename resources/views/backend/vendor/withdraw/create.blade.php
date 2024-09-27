@extends('backend.vendor.dashboard.layouts.master')
@section('title')
    {{ $settings->site_name }} || Create Withdraw Request
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
                        <h3><i class="far fa-user"></i>Create Withdraw Request</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="row">
                                <div class="wsus__dash_pro_area col-md-6 mr-1">

                                    <form action="{{ route('vendor.withdraw.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-12 wsus__input">
                                                <label>Method</label>
                                                <select name="method" id="method" class="form-control" >
                                                    <option value="">Select</option>
                                                    @foreach ($methods as $method)
                                                        <option value="{{$method->id}}">{{$method->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 wsus__input">
                                                <label>Withdraw Amount</label>
                                                <input type="text" class="form-control" name="withdraw_amount" value="">
                                            </div>
                                            <div class="form-group col-md-12 wsus__input">
                                                <label>Account Information</label>
                                                <textarea name="account_info" id="" cols="30" rows="8" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </form>
                                </div>
                                <div class="wsus__dash_pro_area col-md-6 account_info_area">

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
@push('scripts')
    <script>
        $(document).ready(function(){
            $('#method').on('change', function(e){
                let id=$(this).val();
                $.ajax({
                    method: "GET",
                    url: "{{ route('vendor.withdraw.show', ':id') }}".replace(':id', id),

                    success: function(response){
                        $('.account_info_area').html(`
                            <h3>Payout Range : {{$settings->currency_icon}}${response.minimum_amount} - {{$settings->currency_icon}}${response.maximum_amount}</h3>
                            <h3>Withdraw Charge : ${response.withdraw_charge}%</h3>
                            <p>${response.description}</p>
                        `);
                    },
                    error:function(xhr, status, error){
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
