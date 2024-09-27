@extends('frontend.layouts.master')
@section('title')
    {{ $settings->site_name }} || Cart Details
@endsection
@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>cart View</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">cart view</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


<!--============================
    CART VIEW PAGE START
==============================-->
<section id="wsus__cart_view">
    <div class="container">
        <div class="row">
            <div class="col-xl-9">
                <div class="wsus__cart_list">
                    <div class="table-responsive">
                        <table>
                            <tbody>
                                <tr class="d-flex">
                                    <th class="wsus__pro_img">
                                        product item
                                    </th>

                                    <th class="wsus__pro_name">
                                        product details
                                    </th>

                                    {{-- <th class="wsus__pro_status">
                                        status
                                    </th> --}}

                                    <th class="wsus__pro_tk">
                                       unit price
                                    </th>

                                    <th class="wsus__pro_tk">
                                        total
                                    </th>

                                    <th class="wsus__pro_select">
                                        quantity
                                    </th>

                                    <th class="wsus__pro_icon">
                                        <a href="#" class="common_btn clear_cart">clear cart</a>
                                    </th>
                                </tr>
                                @foreach ($cartItems as $item)


                                <tr class="d-flex">
                                    <td class="wsus__pro_img"><img src="{{ asset($item->options->image)}}" alt="product"
                                            class="img-fluid w-100">
                                    </td>
                                    <td class="wsus__pro_name">
                                        <p>{!! $item->name!!}</p>
                                        @foreach ($item->options->variants as $key=>$variant)
                                        <span>{{$key}}: {{$variant['name']}} ({{$settings->currency_icon.$variant['price']}})</span>
                                        @endforeach
                                    </td>
                                    <td class="wsus__pro_tk">
                                        <h6>{{$settings->currency_icon.$item->price}}</h6>
                                    </td>
                                    <td class="wsus__pro_tk">
                                        <h6 id="{{$item->rowId}}">{{$settings->currency_icon.($item->price+$item->options->variants_total) * $item->qty}}</h6>
                                    </td>
                                    <td class="wsus__pro_select">
                                        <div class="product_qty_wrapper">
                                            <button class="btn btn-danger product-decrement">-</button>
                                            <input class="product_qty" data-rowid="{{$item->rowId}}" type="text" min="1" max="100"
                                                value="{{$item->qty}}" readonly/>
                                                <button class="btn btn-success product-increment">+</button>
                                        </div>
                                    </td>
                                    <td class="wsus__pro_icon">
                                        <a href="{{route('cart.remove-product', $item->rowId)}}"><i class="far fa-times"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @if (count($cartItems) === 0)
                                <tr class="d-flex">
                                    <td class="wsus__pro_icon" style="width: 100%">
                                        Cart is empty!
                                    </td>
                                </tr>

                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                    <h6>total cart</h6>
                    <p>subtotal: <span id="sub_total">{{$settings->currency_icon}}{{getCartTotal()}}</span></p>
                    <p>Coupon: <span id="discount">{{$settings->currency_icon}}{{getCartDiscount()}}</span></p>
                    <p class="total"><span>total:</span> <span id="cart_total">{{$settings->currency_icon}}{{getMainCartTotal()}}</span></p>

                    <form id="coupon_apply">
                        <input type="text" placeholder="Coupon Code" name="coupon_code" value="{{session()->has('coupon') ? session()->get('coupon')['coupon_code'] : ''}}">
                        <button type="submit" class="common_btn">apply</button>
                    </form>
                    <a class="common_btn mt-4 w-100 text-center" href="{{route('user.checkout')}}">checkout</a>
                    <a class="common_btn mt-1 w-100 text-center" href="{{route('fronted.home')}}"><i
                            class="fab fa-shopify"></i> Keep Shopping</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="wsus__single_banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="wsus__single_banner_content">
                    @if ($cart_banner->banner_one->banner_one_status == 1)
                    <div class="wsus__single_banner_img">
                        <img src="{{asset($cart_banner->banner_one->banner_one_image)}}" alt="banner" class="img-fluid w-100">
                    </div>
                    <div class="wsus__single_banner_text">
                        <h6>sell on <span>35% off</span></h6>
                        <h3>smart watch</h3>
                        <a class="shop_btn" href="{{$cart_banner->banner_one->banner_one_url}}">shop now</a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="wsus__single_banner_content single_banner_2">
                    @if ($cart_banner->banner_two->banner_two_status == 1)

                    <div class="wsus__single_banner_img">
                        <img src="{{asset($cart_banner->banner_two->banner_two_image)}}" alt="banner" class="img-fluid w-100">
                    </div>
                    <div class="wsus__single_banner_text">
                        <h6>New Collection</h6>
                        <h3>Cosmetics</h3>
                        <a class="shop_btn" href="{{$cart_banner->banner_two->banner_two_url}}">shop now</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================
        CART VIEW PAGE END
==============================-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            // product increment
            $('.product-increment').on('click', function(){
                let input=$(this).siblings('.product_qty');
                // console.log(input);
                let quantity=parseInt(input.val()) + 1;
                let rowId=input.data('rowid');

                input.val(quantity);
                // console.log(quantity);
                $.ajax({
                    url:'{{route('cart.update-product-quantity')}}',
                    method:'POST',
                    data: {
                        rowId:rowId,
                        quantity:quantity
                    },
                    success:function(data){
                        if(data.status==='success'){
                            let productTotal='#'+rowId;
                            let totalAmount="{{$settings->currency_icon}}"+data.product_total;
                            $(productTotal).text(totalAmount);
                            renderCartSubTotal()
                            calculateDiscountCoupon();
                            toastr.success(data.message)
                        }else if(data.status==='error'){
                            toastr.error(data.message);
                        }
                    },
                    error:function(xhr, status, error){

                    }
                })
            })
            //! product decrement
            $('.product-decrement').on('click', function(){
                let input=$(this).siblings('.product_qty');
                // console.log(input);
                let quantity=parseInt(input.val()) - 1;
                let rowId=input.data('rowid');
                if(quantity < 1){
                    quantity=1;
                }
                input.val(quantity);
                // console.log(quantity);
                $.ajax({
                    url:'{{route('cart.update-product-quantity')}}',
                    method:'POST',
                    data: {
                        rowId:rowId,
                        quantity:quantity
                    },
                    success:function(data){
                        if(data.status==='success'){
                            let productTotal='#'+rowId;
                            let totalAmount="{{$settings->currency_icon}}"+data.product_total;
                            $(productTotal).text(totalAmount);
                            renderCartSubTotal()
                            calculateDiscountCoupon()
                            toastr.success(data.message)
                        }else if(data.status==='errors'){
                            toastr.error(data.message);
                        }
                    },
                    error:function(xhr, status, error){

                    }
                })
            })
            // clear cart
            $('.clear_cart').on('click', function(e){
                e.preventDefault();
                Swal.fire({
                title: "Are you sure?",
                text: "This action will clear your cart!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, clear it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'get',
                        url: "{{route('clear.cart')}}",
                        success: function(data){
                            if(data.status==='success'){
                                window.location.reload();
                            }
                        },
                        error: function(xhr, status, error){
                            console.log(error);
                        }
                    });
                }
            });
        })

        // render subtotal for Total cart:
        // get sustoal on cart and put it on dom:
        function renderCartSubTotal(){
            $.ajax({
                    method: 'get',
                    url: "{{ route('cart.sidebar-product-total') }}",
                    success: function(data) {
                    //    console.log(data);
                    $('#sub_total').text("{{ $settings->currency_icon }}" + data);
                    }
                })
            }

        // coupon apply
        $('#coupon_apply').on('submit', function(e){
            e.preventDefault();
            // alert('apply');
            let formData = $(this).serialize();
            $.ajax({
                method: 'get',
                url: "{{ route('cart.apply-coupon') }}",
                data: formData,
                success: function(data){
                    if(data.status==='error'){
                       toastr.error(data.message);
                    }else if(data.status==='success'){
                        calculateDiscountCoupon();
                        toastr.success(data.message);
                    }
                },
                error: function(xhr, status, error){
                    console.log(error);
                }
            })
        })
        // calculate discount coupon
        function calculateDiscountCoupon(){
            $.ajax({
                method: 'get',
                url: "{{ route('coupon.calculation') }}",
                success: function(data) {
                if(data.status==='success'){
                    $('#discount').text("{{ $settings->currency_icon }}" + data.discount);
                    $('#cart_total').text("{{ $settings->currency_icon }}" + data.cart_total);
                    }
                },
                error: function(xhr, status, error){
                    // console.log(error);
                }
            })
        }



        })
    </script>
@endpush
