@extends('backend.admin.layouts.master')
@section('content')
<!-- Main Content -->

<section class="section">
    <div class="section-header">
    <h1> Details</h1>
    </div>
    <div class="section-body">
    <div class="invoice">
        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Withdraw Method</th>
                            <td>{{$request->method}}</td>
                        </tr>
                        <tr>
                            <th>Withdraw Charge</th>
                            <td>{{($request->withdraw_charge / $request->total_amount) * 100}}%</td>
                        </tr>
                        <tr>
                            <th>Withdraw Charge Amount</th>
                            <td>{{$settings->currency_icon}}{{$request->withdraw_charge}}</td>
                        </tr>
                        <tr>
                            <th>Total Amount</th>
                            <td>{{$settings->currency_icon}}{{$request->total_amount}}</td>
                        </tr>
                        <tr>
                            <th>Withdraw Amount</th>
                            <td>{{$settings->currency_icon}}{{$request->withdraw_amount}}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                            @if ($request->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif ($request->status == 'paid')
                                <span class="badge badge-success">Paid</span>
                            @else
                                <span class="badge badge-danger">Declined</span>
                            @endif
                        </td>
                        </tr>
                        <tr>
                            <th>Account Information</th>
                            <td>{!! $request->account_info!!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
<section class="section">
    <div class="section-body">
    <div class="invoice">
        <div class="row mt-4">
            <div class="col-md-6">
                <form action="{{route('admin.withdraw.update', $request->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="inputState">Status</label>
                        <select id="inputState" class="form-control" name="status">
                          <option @selected($request->status=='pending') value="pending">Pending</option>
                          <option @selected($request->status=='paid') value="paid">Paid</option>
                          <option @selected($request->status=='declined') value="declined">Declined</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush

