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
            <div class="table-responsive">
                <table class="table table-striped table-hover table-md">
                <tr>
                    <td>User Name</td>
                    <td>{{$vendor->user->name}}</td>
                </tr>
                <tr>
                    <td>Shop Name</td>
                    <td>{{$vendor->shop_name}}</td>
                </tr>
                <tr>
                    <td>Shop Email</td>
                    <td>{{$vendor->user->email}}</td>
                </tr>
                <tr>
                    <td>Shop Phone</td>
                    <td>{{$vendor->phone}}</td>
                </tr>
                <tr>
                    <td>Shop Address</td>
                    <td>{{$vendor->address}}</td>
                </tr>
                <tr>
                    <td>Shop Description</td>
                    <td>{{$vendor->description}}</td>
                </tr>
                </table>
            </div>
            <div class="row mt-4">
                <div class="col-md-8">
                <div class="col-md-5">
                    <form action="{{route('admin.vendor-request.change-status', $vendor->id)}}" method="post">
                        @csrf
                        @method('put')
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="payment_status" class="form-control">
                            <option {{$vendor->status==0 ? 'selected' : ''}}  value="0">Pending</option>
                            <option {{$vendor->status==1 ? 'selected' : ''}} value="1">Approve</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            //order status change
            $('#order_status').on('change', function(){
                let status=$(this).val();
                let id = $(this).data('id');
                $.ajax({
                    url:"{{route('admin.order-status')}}",
                    method:'get',
                    data:{
                        status:status,
                        id:id
                    },
                    success:function(data){
                        if(data.status==='success'){
                            toastr.success(data.message);
                        }
                    },
                    error:function(data){
                        console.log(data);
                    }
            })
        })
        //payment status change
        $('#payment_status').on('change', function(){
            let status=$(this).val();
            let id = $(this).data('id');
            $.ajax({
                url:"{{route('admin.payment-status')}}",
                method:'get',
                data:{
                    status:status,
                    id:id
                },
                success:function(data){
                    if(data.status==='success'){
                        toastr.success(data.message);
                    }
                },
                error:function(data){
                    console.log(data);
                }
            })
        })

    });
    </script>
@endpush

