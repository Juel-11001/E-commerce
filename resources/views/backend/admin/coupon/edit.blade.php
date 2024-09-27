@extends('backend.admin.layouts.master')
@section('content')
<!-- Main Content -->

<section class="section">
<div class="section-header">
    <h1>Coupon</h1>
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
                    <h4>Update Coupon</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{$coupon->name}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Code</label>
                                <input type="text" class="form-control" name="code" value="{{$coupon->code}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Quantity</label>
                                <input type="number" class="form-control" name="qty" value="{{$coupon->quantity}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Max Use Per Person</label>
                                <input type="number" class="form-control " name="max_use" value="{{$coupon->max_use}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Start Date</label>
                                <input type="text" class="form-control datepicker" name="start_date"
                                    value="{{$coupon->start_date}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>End Date</label>
                                <input type="text" class="form-control datepicker " name="end_date"
                                    value="{{$coupon->end_date}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Discount Type</label>
                                <select class="form-control" name="discount_type">
                                    <option value="">Select</option>
                                    <option {{$coupon->discount_type=='percentage' ? 'selected' : ''}} value="percentage">Percentage (%)</option>
                                    <option {{$coupon->discount_type=='amount' ? 'selected' : ''}} value="amount">Amount {{ $settings->currency_icon }}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Discount Value</label>
                                <input type="number" class="form-control" name="discount" value="{{$coupon->discount}}">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                                <option value="">Select</option>
                                <option {{$coupon->status==1 ? 'selected' : ''}} value="1">Active</option>
                                <option {{$coupon->status==0 ? 'selected' : ''}} value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
