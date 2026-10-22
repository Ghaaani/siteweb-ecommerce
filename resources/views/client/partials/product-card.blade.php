@php
    $image = $product->image ? asset('storage/images/product/'.$product->image) : asset('client/img/product/1.jpg');
    $badge = $product->product_list ?: 'New arrival';
@endphp
<div class="product-item ecom-product-card">
    <div class="product-img">
        <a href="/single_product/{{ $product->id }}"><img src="{{ $image }}" alt="{{ $product->name }}"></a>
        <span class="ecom-badge">{{ $badge }}</span>
        <button type="button" class="ecom-wish" data-product-id="{{ $product->id }}" onclick="ecomToggleWishlist({{ $product->id }}, this)" title="Add to wish list" aria-label="Add to wish list">
            <i class="zmdi zmdi-favorite"></i>
        </button>
    </div>
    <div class="product-info">
        <h6 class="product-title">
            <a href="/single_product">{{ $product->name }}</a>
        </h6>
        <div class="pro-rating">
            <a href="#" onclick="return false;"><i class="zmdi zmdi-star"></i></a>
            <a href="#" onclick="return false;"><i class="zmdi zmdi-star"></i></a>
            <a href="#" onclick="return false;"><i class="zmdi zmdi-star"></i></a>
            <a href="#" onclick="return false;"><i class="zmdi zmdi-star-half"></i></a>
            <a href="#" onclick="return false;"><i class="zmdi zmdi-star-outline"></i></a>
        </div>
        <h3 class="pro-price">${{ number_format($product->price, 2) }}</h3>
        <p class="ecom-product-desc">{{ \Illuminate\Support\Str::limit($product->description, 70) }}</p>
        <div class="ecom-card-actions">
            <button type="button" class="ecom-btn-add" onclick="ecomAddToCart({{ $product->id }})">
                <i class="zmdi zmdi-shopping-cart-plus"></i> Add to cart
            </button>
            <button type="button" class="ecom-btn-buy" onclick="ecomBuyNow({{ $product->id }})">
                Buy now
            </button>
        </div>
    </div>
</div>
