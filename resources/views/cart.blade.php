@extends('client.layouts.app')

@section('content')

        <!-- Start page content -->
        <section id="page-content" class="page-wrapper section">

            <!-- SHOP SECTION START -->
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-center mb-40">
                                <h2 class="uppercase">Shopping cart</h2>
                                <h6>Review the products in your cart before heading to checkout.</h6>
                            </div>

                            @if($cartItems->isNotEmpty())
                            <div class="shopping-cart-content">
                                <div class="table-content table-responsive mb-50">
                                    <table class="text-center">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">Product</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-quantity">Quantity</th>
                                                <th class="product-subtotal">Total</th>
                                                <th class="product-remove">Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody id="product-container">
                                            @foreach($cartItems as $item)
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <div class="pro-thumbnail-img">
                                                        <img src="{{ asset('storage/images/product/'.$item->product->image) }}" alt="{{ $item->name }}">
                                                    </div>
                                                    <div class="pro-thumbnail-info text-start">
                                                        <h6 class="product-title-2">
                                                            <a href="/single_product">{{ $item->name }}</a>
                                                        </h6>
                                                        <p>Product ID: {{ $item->product_id }}</p>
                                                    </div>
                                                </td>
                                                <td class="product-price">${{ $item->prix }}</td>
                                                <td class="product-quantity">
                                                    <div class="cart-plus-minus f-left">
                                                        <div class="dec qtybutton"><button onclick="decQuantity('{{ $item->id }}')">-</button></div>
                                                        <input type="text" value="{{ $item->quantity }}" name="qtybutton" class="cart-plus-minus-box" data-product-id="{{ $item->id }}" readonly>
                                                        <div class="inc qtybutton"><button onclick="incQuantity('{{ $item->id }}')">+</button></div>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal">${{ number_format($item->prix * $item->quantity, 2) }}</td>
                                                <td class="product-remove">
                                                    <button onclick="Remove('{{ $item->id }}')"><i class="zmdi zmdi-close"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="coupon-discount box-shadow p-30 mb-50">
                                            <h6 class="widget-title border-left mb-20">Coupon discount</h6>
                                            <p>Enter your coupon code if you have one!</p>
                                            <input type="text" id="coupon-code" placeholder="Enter your code here.">
                                            <button class="submit-btn-1 black-bg btn-hover-2" type="button" id="apply-coupon">Apply coupon</button>
                                            <p id="coupon-message" class="mt-10"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="payment-details box-shadow p-30 mb-50">
                                            <h6 class="widget-title border-left mb-20">Payment details</h6>
                                            <table>
                                                <tr>
                                                    <td class="td-title-1">Cart Subtotal</td>
                                                    <td class="td-title-2">${{ number_format($totalPrice, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-title-1">Shipping and Handling</td>
                                                    <td class="td-title-2">$0.00</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-title-1">Vat</td>
                                                    <td class="td-title-2">$0.00</td>
                                                </tr>
                                                <tr>
                                                    <td class="order-total">Order Total</td>
                                                    <td class="order-total-price">${{ number_format($totalPrice, 2) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="culculate-shipping box-shadow p-30">
                                            <h6 class="widget-title border-left mb-20">Calculate shipping</h6>
                                            <p>Enter your coupon code if you have one!</p>
                                            <div class="row">
                                                <div class="col-sm-4 col-xs-12">
                                                    <input type="text" id="ship-country" placeholder="Country">
                                                </div>
                                                <div class="col-sm-4 col-xs-12">
                                                    <input type="text" id="ship-state" placeholder="Region / State">
                                                </div>
                                                <div class="col-sm-4 col-xs-12">
                                                    <input type="text" id="ship-code" placeholder="Post code">
                                                </div>
                                                <div class="col-md-12">
                                                    <button class="submit-btn-1 black-bg btn-hover-2" type="button" id="get-quote">Get a quote</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a href="/checkout" class="button" id="checkout-btn">Proceed to checkout</a>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="empty-cart box-shadow p-60 text-center">
                                <h4 class="mb-20">Your cart is empty</h4>
                                <p class="mb-30">Looks like you haven't added anything yet.</p>
                                <a href="/shop" class="button">Go shopping</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- SHOP SECTION END -->

        </section>
        <!-- End page content -->

<script>
    var cartCoupons = { 'SAVE10': 0.10 };

    function renderCart(items) {
        var container = $('#product-container');
        container.empty();

        if (!items || items.length === 0) {
            container.html('<tr><td colspan="5" class="text-center p-30">Your cart is empty.</td></tr>');
            return;
        }

        $.each(items, function(index, item) {
            var row = $('<tr>' +
                '<td class="product-thumbnail">' +
                    '<div class="pro-thumbnail-img"><img src="/storage/images/product/' + (item.image || '1.jpg') + '" alt="' + item.name + '" /></div>' +
                    '<div class="pro-thumbnail-info text-start">' +
                        '<h6 class="product-title-2"><a href="/single_product/' + item.product_id + '">' + item.name + '</a></h6>' +
                    '</div>' +
                '</td>' +
                '<td class="product-price">' + item.prix + '</td>' +
                '<td class="product-quantity">' +
                    '<div class="cart-plus-minus f-left">' +
                        '<div class="dec qtybutton"><button onclick="decQuantity(' + item.id + ')">-</button></div>' +
                        '<input type="text" value="' + item.quantity + '" name="qtybutton" class="cart-plus-minus-box" data-product-id="' + item.id + '" readonly>' +
                        '<div class="inc qtybutton"><button onclick="incQuantity(' + item.id + ')">+</button></div>' +
                    '</div>' +
                '</td>' +
                '<td class="product-subtotal">' + item.line_total + '</td>' +
                '<td class="product-remove">' +
                    '<button onclick="Remove(' + item.id + ')" title="Remove"><i class="zmdi zmdi-close"></i></button>' +
                '</td>' +
            '</tr>');
            container.append(row);
        });
    }

    function loadCart() {
        $.ajax({
            url: '/cart',
            type: 'GET',
            dataType: 'json',
            success: function(response) { renderCart(response.products); updateCartBadge(); },
            error: function(error) { console.error('Error fetching cart:', error); }
        });
    }

    function incQuantity(productId) {
        $.ajax({
            url: '/inc-quantity/' + productId,
            type: 'GET',
            success: function(response) {
                var $input = $('.cart-plus-minus-box[data-product-id="' + productId + '"]');
                var current = parseInt($input.val()) || 1;
                $input.val(current + 1);
                loadCart();
            },
            error: function(error) { console.error('Error updating product quantity:', error); }
        });
    }

    function decQuantity(productId) {
        var $input = $('.cart-plus-minus-box[data-product-id="' + productId + '"]');
        var current = parseInt($input.val()) || 1;
        $.ajax({
            url: '/update-product-quantity/' + productId,
            type: 'POST',
            data: { quantity: current - 1 },
            success: function(response) { loadCart(); },
            error: function(error) { console.error('Error updating product quantity:', error); }
        });
    }

    function Remove(id) {
        ecomRemoveFromCart(id, function () { loadCart(); });
    }

    $('#apply-coupon').on('click', function() {
        var code = $('#coupon-code').val();
        var msg = $('#coupon-message');
        if (Object.prototype.hasOwnProperty.call(cartCoupons, code)) {
            msg.text('Coupon applied: ' + code);
            msg.css('color', 'var(--ecom-success)');
        } else {
            msg.text('Invalid coupon code.');
            msg.css('color', 'var(--ecom-danger)');
        }
    });

    $('#get-quote').on('click', function() {
        var country = $('#ship-country').val();
        if (!country) { alert('Please enter a country to get a shipping quote.'); return; }
        alert('Shipping quote for ' + country + ' calculated at checkout.');
    });

    loadCart();

</script>

@endsection
