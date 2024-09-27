@extends('backend.admin.layouts.master')
@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Withdraw Method</h1>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Method</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.withdraw-method.update', $method->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" value="{{$method->name}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Withdraw Charge (<code>%</code>)</label>
                                        <input type="text" class="form-control" name="withdraw_charge" value="{{$method->withdraw_charge}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Minimum Amount</label>
                                        <input type="text" class="form-control" name="minimum_amount" value="{{$method->minimum_amount}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Maximum Amount</label>
                                        <input type="text" class="form-control" name="maximum_amount" value="{{$method->maximum_amount}}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Description</label>
                                        <textarea name="description" id="" cols="30" rows="10" class="summernote">{!!$method->description!!}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
