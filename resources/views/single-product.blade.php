@extends('client.layouts.app')

@section('title', $product->name)
@section('meta', \Illuminate\Support\Str::limit(strip_tags($product->description), 150) ?: 'Product details')

@section('content')

        <!-- Start page content -->
        <section id="page-content" class="page-wrapper section">
            <div class="single-product-area section ptb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="single-product-img">
                                @php
                                    $mainImage = $product->image ? asset('storage/images/product/'.$product->image) : asset('client/img/product/1.jpg');
                                    $mainDims = ($product->image && is_file(public_path('storage/images/product/'.$product->image))) ? getimagesize(public_path('storage/images/product/'.$product->image)) : null;
                                    $inWishlist = in_array($product->id, (array) session('wishlist', []));
                                @endphp
                                <img src="{{ $mainImage }}" alt="{{ $product->name }}"
                                    @if($mainDims) width="{{ $mainDims[0] }}" height="{{ $mainDims[1] }}" @endif
                                    fetchpriority="high" decoding="async">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="single-product-content">
                                <h1 class="uppercase">{{ $product->name }}</h1>
                                <p class="text-black-5">SKU: {{ $product->SKU }}</p>
                                <button type="button" class="ecom-wish {{ $inWishlist ? 'is-active' : '' }}" data-product-id="{{ $product->id }}" onclick="ecomToggleWishlist({{ $product->id }}, this)" title="Add to wish list" aria-label="Add to wish list" style="position:static;display:inline-flex;">
                                    <i class="zmdi {{ $inWishlist ? 'zmdi-favorite' : 'zmdi-favorite-outline' }}"></i>
                                </button>
                                <p class="pro-rating mb-20" aria-label="Rated 4 and a half stars out of 5">
                                    <span class="rate-icons" aria-hidden="true">
                                        <i class="zmdi zmdi-star"></i>
                                        <i class="zmdi zmdi-star"></i>
                                        <i class="zmdi zmdi-star"></i>
                                        <i class="zmdi zmdi-star-half"></i>
                                        <i class="zmdi zmdi-star-outline"></i>
                                    </span>
                                </p>
                                <div class="price-box-3 mb-20">
                                    <div class="s-price-box">
                                        <span class="new-price">${{ number_format($product->price, 2) }}</span>
                                    </div>
                                </div>
                                <p class="mb-30">{{ $product->description }}</p>

                                <div class="product-quantity mb-30">
                                    <label class="d-block mb-10" for="product-qty">Quantity</label>
                                    <div class="cart-plus-minus">
                                        <div class="dec qtybutton"><button type="button" onclick="ecomChangeQty(-1)" aria-label="Decrease quantity">−</button></div>
                                        <input type="text" id="product-qty" value="1" inputmode="numeric" class="cart-plus-minus-box" readonly>
                                        <div class="inc qtybutton"><button type="button" onclick="ecomChangeQty(1)" aria-label="Increase quantity">+</button></div>
                                    </div>
                                </div>

                                <div class="ecom-card-actions mb-30" style="max-width: 420px;">
                                    <button type="button" class="ecom-btn-add" onclick="ecomAddQtyToCart()">
                                        <i class="zmdi zmdi-shopping-cart-plus" aria-hidden="true"></i> Add to cart
                                    </button>
                                    <button type="button" class="ecom-btn-buy" onclick="ecomBuyQtyNow()">Buy now</button>
                                </div>

                                <ul class="list-unstyled ecom-product-meta">
                                    <li><i class="zmdi zmdi-check" aria-hidden="true"></i> Free delivery over $99</li>
                                    <li><i class="zmdi zmdi-check" aria-hidden="true"></i> 30 day returns</li>
                                    <li><i class="zmdi zmdi-check" aria-hidden="true"></i> Pay with PayPal, credit or debit card</li>
                                </ul>

                                <div class="social-sharing mt-30">
                                    <h3 class="widget-title-modal">Share this product</h3>
                                    <ul class="social-icons clearfix">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" title="Share on Facebook"><i class="zmdi zmdi-facebook"></i></a></li>
                                        <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($product->name) }}" target="_blank" rel="noopener" title="Share on X"><i class="zmdi zmdi-twitter"></i></a></li>
                                        <li><a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&description={{ urlencode($product->name) }}" target="_blank" rel="noopener" title="Pin it"><i class="zmdi zmdi-pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($related->count())
            <div class="up-comming-product-section ptb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 mb-30">
                            <div class="section-title text-start">
                                <h2 class="uppercase">You may also like</h2>
                                <h6>More pieces from the same collection.</h6>
                            </div>
                        </div>
                        @foreach($related as $item)
                            <div class="col-lg-3 col-md-6">
                                @include('client.partials.product-card', ['product' => $item])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </section>
        <!-- End page content -->

<script>
    var productId = {{ $product->id }};

    function ecomChangeQty(step) {
        var input = document.getElementById('product-qty');
        var value = (parseInt(input.value) || 1) + step;
        if (value < 1) { value = 1; }
        input.value = value;
    }

    function ecomAddQtyToCart() {
        var qty = parseInt(document.getElementById('product-qty').value) || 1;
        for (var i = 0; i < qty; i++) {
            ecomAddToCart(productId);
        }
    }

    function ecomBuyQtyNow() {
        var qty = parseInt(document.getElementById('product-qty').value) || 1;
        var added = 0;
        var addOne = function () {
            if (added >= qty) {
                window.location.href = '/checkout';
                return;
            }
            added++;
            ecomAddToCart(productId, addOne);
        };
        addOne();
    }
</script>

@endsection
