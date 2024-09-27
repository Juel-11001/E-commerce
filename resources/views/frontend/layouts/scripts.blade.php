<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // add to cart
        $(document).on('submit', '.shopping-cart-form', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            // console.log(formData);
            $.ajax({
                url: "{{ route('add-to-cart') }}",
                method: 'POST',
                data: formData,
                success: function(data) {
                    // console.log(data);

                    if (data.status === 'success') {
                        getCartCount()
                        getSidebarCartProducts()
                        $('.mini_cart_actions').removeClass('d-none');
                        toastr.success(data.message);
                    } else if (data.status === 'error') {
                        toastr.error(data.message);
                    }

                },
                error: function(data) {

                    // console.log(data);
                }
            })

        })

        // get cart count
        function getCartCount() {
            $.ajax({
                method: 'get',
                url: "{{ route('cart.count') }}",
                success: function(data) {
                    $('#cart_count').text(data);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        }
        //fetch sidebar cart products
        function getSidebarCartProducts() {
            $.ajax({
                method: 'get',
                url: "{{ route('cart-products') }}",
                success: function(data) {
                    // $('#sidebar_cart_products').html(data);
                    // console.log(data);
                    $('.mini_cart_wrapper').html("");
                    var html = '';
                    for (let item in data) {
                        // console.log(data[item]);
                        let product = data[item];
                        html += `
                    <li id='mini_cart_${product.rowId}'>
                        <div class="wsus__cart_img">
                            <a href="#"><img src="{{ asset('/') }}${product.options.image}" alt="product" class="img-fluid w-100"></a>
                            <a class="wsis__del_icon remove_sidebar_product" data-rowid="${product.rowId}" href="#"><i class="fas fa-minus-circle"></i></a>
                        </div>
                        <div class="wsus__cart_text">
                            <a class="wsus__cart_title" href="#">${product.name}</a>
                            <p>{{ $settings->currency_icon }}${product.price}</p>
                            <small>Qty: ${product.qty}</small> <br>
                            <small>Variants total: {{ $settings->currency_icon }}${product.options.variants_total}</small>
                        </div>
                        </li>
                    `
                    }
                    // console.log(html);

                    $('.mini_cart_wrapper').html(html);
                    getSidebarCartSubTotal()
                },
                error: function(xhr, status, error) {}
            })
        }

        // remove sidebar product form cart
        $('body').on('click', '.remove_sidebar_product', function(e) {
            e.preventDefault();
            let rowId = $(this).data('rowid');
            $.ajax({
                url: "{{ route('cart.remove-sidebar-product') }}",
                method: 'post',
                data: {
                    rowId: rowId
                },
                success: function(data) {
                    let productId = '#mini_cart_' + rowId;
                    $(productId).remove()
                    getSidebarCartSubTotal()
                    if ($('.mini_cart_wrapper').find('li').length === 0) {
                        $('.mini_cart_actions').addClass('d-none');
                        $('.mini_cart_wrapper').html(
                            '<li class="text-center">Cart is empty!</li>');
                    }
                    getCartCount()
                    toastr.success(data.message);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        })

        // get sidebar cart subtotal
        function getSidebarCartSubTotal() {
            $.ajax({
                method: 'get',
                url: "{{ route('cart.sidebar-product-total') }}",
                success: function(data) {
                    $('#mini_cart_subtotal').text("{{ $settings->currency_icon }}" + data);

                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        }

        //add to wishlist
        $(document).on('click','.wish_list', function(e) {
            // alert('add to wishlist');
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('wishlist.add-product') }}",
                method: 'get',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.status === 'success') {
                        $('#wishlist_count').text(data.count);
                        toastr.success(data.message);
                    } else if (data.status === 'error') {
                        toastr.error(data.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    if (xhr.status === 401) {
                    toastr.error('Please Login First');
                    } else {
                        toastr.error('An error occurred: ' + error);
                    }
                }
            })
        });

        // news letter

        $('#newsletter').on('submit', function(e) {
            e.preventDefault();
            let data = $(this).serialize();
            $.ajax({
                url: "{{ route('newsletter.request') }}",
                method: 'post',
                data: data,
                beforeSend: function() {
                    $('.subscriber_btn').text('Loading...');
                },
                success: function(data) {
                    if (data.status === 'success') {
                        $('.subscriber_btn').text('Subscribe');
                        $('.newsletter-email').val('');
                        toastr.success(data.message);
                    } else if (data.status === 'error') {
                        toastr.error(data.message);
                    }
                },
                error: function(data) {
                    let errors = data.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function(key, value) {
                            // alert(value);
                            toastr.error(value);
                        });
                    }

                    $('.subscriber_btn').text('Subscribe');
                },
            })
        })

        // show model view
        $('.show_product_model').on('click', function(){
            let id= $(this).data('id');
            $.ajax({
                url: "{{ route('show-product-model', ":id") }}".replace(":id", id),
                method: 'get',
                beforeSend: function() {
                    $('.product_model_content').html('<span class="loader"></span>');
                },
                success: function(response) {
                    $('.product_model_content').html(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                },
                complete: function() {

                }
            })
        })

    })
</script>
