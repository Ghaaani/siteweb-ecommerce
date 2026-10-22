@php
    $image = $product->image ? asset('storage/images/product/'.$product->image) : asset('client/img/product/1.jpg');
    $badge = $product->product_list ?: 'New arrival';
    $dimensions = null;
    if ($product->image && is_file(public_path('storage/images/product/'.$product->image))) {
        $dimensions = getimagesize(public_path('storage/images/product/'.$product->image));
    }
@endphp
<div class="product-item ecom-product-card">
    <div class="product-img">
        <a href="/single_product/{{ $product->id }}">
            <img src="{{ $image }}" alt="{{ $product->name }}"
                @if($dimensions) width="{{ $dimensions[0] }}" height="{{ $dimensions[1] }}" @endif
                loading="lazy" decoding="async">
        </a>
        <span class="ecom-badge">{{ $badge }}</span>
        <button type="button" class="ecom-wish" data-product-id="{{ $product->id }}" onclick="ecomToggleWishlist({{ $product->id }}, this)" title="Add to wish list" aria-label="Add to wish list">
            <i class="zmdi zmdi-favorite" aria-hidden="true"></i>
        </button>
    </div>
    <div class="product-info">
        <h6 class="product-title">
            <a href="/single_product/{{ $product->id }}">{{ $product->name }}</a>
        </h6>
        <p class="pro-rating" aria-label="Rated 4 and a half stars out of 5">
            <span class="rate-icons" aria-hidden="true">
                <i class="zmdi zmdi-star"></i>
                <i class="zmdi zmdi-star"></i>
                <i class="zmdi zmdi-star"></i>
                <i class="zmdi zmdi-star-half"></i>
                <i class="zmdi zmdi-star-outline"></i>
            </span>
        </p>
        <h3 class="pro-price">${{ number_format($product->price, 2) }}</h3>
        <p class="ecom-product-desc">{{ \Illuminate\Support\Str::limit($product->description, 70) }}</p>
        <div class="ecom-card-actions">
            <button type="button" class="ecom-btn-add" onclick="ecomAddToCart({{ $product->id }})">
                <i class="zmdi zmdi-shopping-cart-plus" aria-hidden="true"></i> Add to cart
            </button>
            <button type="button" class="ecom-btn-buy" onclick="ecomBuyNow({{ $product->id }})">
                Buy now
            </button>
        </div>
    </div>
</div>
