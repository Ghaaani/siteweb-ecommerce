@extends('client.layouts.app')

@section('title', 'Shopping cart')

@section('content')

        <!-- Start page content -->
        <section id="page-content" class="page-wrapper section">

            <!-- SHOP SECTION START -->
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-center mb-40">
                                <h1 class="uppercase">Shopping cart</h1>
                                <p class="section-sub">Review the products in your cart before heading to checkout.</p>
                            </div>

                            @if($cartItems->isNotEmpty())
                            <div class="shopping-cart-content">
                                <div class="table-content table-responsive mb-50">
                                    <table class="text-center ecom-cart-table">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail" scope="col">Product</th>
                                                <th class="product-price" scope="col">Price</th>
                                                <th class="product-quantity" scope="col">Quantity</th>
                                                <th class="product-subtotal" scope="col">Total</th>
                                                <th class="product-remove" scope="col"><span class="visually-hidden">Remove</span></th>
                                            </tr>
                                        </thead>
                                        <tbody id="product-container">
                                            @foreach($cartItems as $item)
                                            <tr data-cart-item="{{ $item->id }}">
                                                <td class="product-thumbnail">
                                                    <div class="pro-thumbnail-img">
                                                        <a href="/single_product/{{ $item->product_id }}">
                                                            <img src="{{ ($item->product && $item->product->image) ? asset('storage/images/product/'.$item->product->image) : asset('client/img/product/1.jpg') }}" alt="{{ $item->name }}" loading="lazy" decoding="async">
                                                        </a>
                                                    </div>
                                                    <div class="pro-thumbnail-info text-start">
                                                        <h6 class="product-title-2">
                                                            <a href="/single_product/{{ $item->product_id }}">{{ $item->name }}</a>
                                                        </h6>
                                                    </div>
                                                </td>
                                                <td class="product-price">${{ $item->prix }}</td>
                                                <td class="product-quantity">
                                                    <div class="cart-plus-minus f-left ecom-qty">
                                                        <div class="dec qtybutton"><button type="button" onclick="decQuantity('{{ $item->id }}')" aria-label="Decrease quantity of {{ $item->name }}">âˆ’</button></div>
                                                        <input type="text" inputmode="numeric" value="{{ $item->quantity }}" name="qtybutton" class="cart-plus-minus-box" data-product-id="{{ $item->id }}" readonly aria-label="Quantity of {{ $item->name }}">
                                                        <div class="inc qtybutton"><button type="button" onclick="incQuantity('{{ $item->id }}')" aria-label="Increase quantity of {{ $item->name }}">+</button></div>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal">${{ number_format($item->prix * $item->quantity, 2) }}</td>
                                                <td class="product-remove">
                                                    <button type="button" onclick="Remove('{{ $item->id }}')" aria-label="Remove {{ $item->name }} from cart"><i class="zmdi zmdi-close" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 offset-md-6">
                                        <div class="payment-details box-shadow p-30 mb-50">
                                            <h2 class="widget-title border-left mb-20">Payment details</h2>
                                            <table>
                                                <tr>
                                                    <td class="td-title-1">Cart subtotal</td>
                                                    <td class="td-title-2">${{ number_format($totalPrice, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-title-1">Shipping and handling</td>
                                                    <td class="td-title-2">Free</td>
                                                </tr>
                                                <tr>
                                                    <td class="order-total">Order total</td>
                                                    <td class="order-total-price">${{ number_format($totalPrice, 2) }}</td>
                                                </tr>
                                            </table>
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
                                <h2 class="mb-20">Your cart is empty</h2>
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
    document.addEventListener('DOMContentLoaded', function () {
        var csrf = function () { return ($('meta[name="csrf-token"]').attr('content') || ''); };

        function settled() {
            window.location.reload();
        }

        window.incQuantity = function (itemId) {
            $.ajax({
                url: '/inc-quantity/' + itemId,
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': csrf() },
                success: settled,
                error: function (error) {
                    console.error('Error updating quantity:', error);
                    if (window.Ecom) { Ecom.toast('Could not update the quantity — please try again', 'error'); }
                }
            });
        };

        window.decQuantity = function (itemId) {
            $.ajax({
                url: '/dec-quantity/' + itemId,
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': csrf() },
                success: settled,
                error: function (error) {
                    console.error('Error updating quantity:', error);
                    if (window.Ecom) { Ecom.toast('Could not update the quantity — please try again', 'error'); }
                }
            });
        };

        window.Remove = function (itemId) {
            if (window.Ecom) {
                Ecom.removeFromCart(itemId, settled);
            } else {
                settled();
            }
        };
    });
</script>

@endsection
