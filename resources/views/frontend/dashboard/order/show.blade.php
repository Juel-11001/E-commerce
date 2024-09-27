@php
    $address=json_decode($order->order_address);
    // dd($address);
    $shipping=json_decode($order->shipping_method);
    // dd($shippingMethod);
    $coupon=json_decode($order->coupon);
@endphp
@extends('frontend.dashboard.layouts.master')
@section('title')
{{$settings->site_name}} || Orders
@endsection
@section('content')
      <!--=============================
    DASHBOARD START
  ==============================-->
   <section id="wsus__dashboard">
    <div class="container-fluid">
      @include('frontend.dashboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <div class="d-flex justify-content-between align-items-center">
                <h3><i class="far fa-user"></i> Order Details</h3>
            </div>

<!--============================
INVOICE PAGE START
==============================-->
<section id="" class="invoice-print">
<div class="">
<div class="wsus__invoice_area">
<div class="wsus__invoice_header">
<div class="wsus__invoice_content">
    <div class="row">
        <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
            <div class="wsus__invoice_single">
                <h5>Billing Information</h5>
                <h6>{{$address->name}}</h6>
                <p>{{$address->email}}</p>
                <p>{{$address->phone}}</p>
                <p>{{$address->address}}, {{$address->city}}, {{$address->state}}, {{$address->zip}}</p>
                <p>{{$address->country}}</p>
            </div>
        </div>
        <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
            <div class="wsus__invoice_single text-md-center">
                <h5>shipping information</h5>
                <h6>{{$address->name}}</h6>
                <p>{{$address->email}}</p>
                <p>{{$address->phone}}</p>
                <p>{{$address->address}}, {{$address->city}}, {{$address->state}}, {{$address->zip}}</p>
                <p>{{$address->country}}</p>
            </div>
        </div>
        <div class="col-xl-4 col-md-4">
            <div class="wsus__invoice_single text-md-end">
                <h5>Order Id : {{$order->invoice_id}}</h5>
                <h6>Order status: {{config('order_status.order_status_admin')[$order->order_status]['status']}}</h6>
                <p>Payment Method: {{$order->payment_method}}</p>
                <p>Payment Status: {{$order->payment_status===1 ? 'Complete' : 'Pending'}}</p>
                <p>Transaction Id: {{$order->transaction->transaction_id}}</p>
            </div>
        </div>
    </div>
</div>
<div class="wsus__invoice_description">
    <div class="table-responsive">
        <table class="table">
            <tr>

                <th class="name">
                    product
                </th>
                <th class="amount">
                    Vendor
                </th>

                <th class="amount">
                    amount
                </th>

                <th class="quentity">
                    quentity
                </th>
                <th class="total">
                    total
                </th>
            </tr>

            @foreach($order->orderProducts as $product)

                @php
                    $variants= json_decode($product->variants);
                    // this is my code for variants
                    // $variants = json_decode($product->variants, true);
                    // $variants = is_array($variants) ? $variants : [];
                @endphp
                <tr>
                    <td class="name">
                        <p>{{$product->product->name}}</p>
                        {{-- <span>color : yellow</span> --}}
                        {{-- <span>size : XL</span> --}}
                        @foreach ($variants as $key => $item)
                            <span>{{$key}}: {{$item->name}} ({{$settings->currency_icon}}{{$item->price}})</span>
                        @endforeach
                        {{-- this is my code for variants --}}
                        {{-- @if (count($variants) > 0)
                        @foreach ($variants as $key => $variant)
                            <span>{{ $key }}: {{ $variant['name']?? 'N/A' }}({{$settings->currency_icon}}{{ $variant['price']}}) <br>
                                {{ $variant['size'] ?? '' }}
                            </span>
                        @endforeach
                    @else
                        <span>No variants available</span>
                    @endif --}}
                    </td>
                    <td class="amount">
                        {{$product->vendor->shop_name}}
                    </td>
                    <td class="amount">
                        {{$settings->currency_icon}}{{$product->unit_price}}
                    </td>


                    <td class="quentity">
                        {{$product->qty}}
                    </td>
                    <td class="total">
                        {{$settings->currency_icon}}{{($product->unit_price * $product->qty) + $product->variants_total*$product->qty}}
                    </td>
                </tr>

            @endforeach
        </table>
    </div>
</div>
</div>
<div class="wsus__invoice_footer">
    <p><span>Sub Total:</span>{{$settings->currency_icon}}{{$order->sub_total}}</p>
    <p><span>Shipping Free:</span>{{$settings->currency_icon}}{{$shipping->cost}}</p>
    <p><span>Coupon:</span>{{$settings->currency_icon}}{{ @ $coupon->discount ? $coupon->discount : 0  }}</p>
    <p><span>Total Amount:</span>{{$settings->currency_icon}}{{$order->amount}}</p>
    <div class="d-flex align-items-center justify-content-end">
        <button class="btn btn-warning btn-icon icon-left btn_print "><i class="fas fa-print"></i> Print</button>
    </div>
</div>
</div>
</div>
</section>
<!--============================
INVOICE PAGE END
==============================-->
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
<script>
     $('document').ready(function() {
        //print
     $('.btn_print').on('click', function(){
            let printBody=$('.invoice-print');
            let originalBody=$('body').html();
            $('body').html(printBody.html());
            window.print();
            $('body').html(originalBody);
        })
    });
</script>
@endpush

