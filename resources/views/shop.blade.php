@extends('client.layouts.app')

@section('title', 'Shop')
@section('meta', 'Browse the full collection — filter by category or search by name.')

@section('content')


        <!-- Start page content -->
        <div id="page-content" class="page-wrapper section">

            <!-- SHOP SECTION START -->
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="section-title text-start mb-30">
                        <h1 class="uppercase">Shop</h1>
                        <p class="section-sub">Browse every product — filter by category or search by name.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-9 order-lg-2 order-2">
                            <div class="shop-content">
                                <!-- showing -->
                                <div class="shop-option box-shadow mb-30 clearfix">
                                    <div class="showing f-right text-end">
                                        <span id="showing-count" role="status">{{ $productss->count() }} {{ Str::plural('product', $productss->count()) }}</span>
                                    </div>
                                </div>
                                <!-- Products grid -->
                                <div class="tab-content">
                                    <div class="tab-pane active show">
                                        <div class="row" id="product-container">
                                            @forelse($productss as $product)
                                                <div class="col-lg-4 col-md-6">
                                                    @include('client.partials.product-card', ['product' => $product])
                                                </div>
                                            @empty
                                                <div class="col-12">
                                                    <div class="empty-cart box-shadow p-60 text-center">
                                                        <h2 class="mb-20">No products yet</h2>
                                                        <p>Products added from the admin area will show up here.</p>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 order-lg-1 order-1">
                            <!-- widget-search -->
                            <aside class="widget-search mb-30">
                                <form action="{{ url('/shop') }}" method="GET" role="search">
                                    <label class="visually-hidden" for="shop-search">Search products</label>
                                    <input type="search" id="shop-search" name="q" value="{{ request('q') }}" placeholder="Search products…" autocomplete="off">
                                    <button type="submit" id="shop-search-btn" aria-label="Search"><i class="zmdi zmdi-search" aria-hidden="true"></i></button>
                                </form>
                            </aside>
                            <!-- widget-categories -->
                            <aside class="widget widget-categories box-shadow mb-30">
                                <h2 class="widget-title border-left mb-20">Categories</h2>
                                <div id="category-buttons" class="product-cat">
                                    <ul>
                                        <li>
                                            <button class="category-btn {{ request('category') ? '' : 'active' }}" data-id="" onclick="fetchProductss('')">All products</button>
                                        </li>
                                        @foreach ($categories as $categorie)
                                            <li>
                                                <button class="category-btn {{ request('category') == $categorie->id ? 'active' : '' }}" data-id="{{ $categorie->id }}" onclick="fetchProductss({{ $categorie->id }})">{{ $categorie->name }}</button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SHOP SECTION END -->

        </div>
        <!-- End page content -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var shopProducts = @json($productss);

        var esc = window.Ecom ? window.Ecom.esc : function (raw) { return String(raw == null ? '' : raw); };

        function productCardHtml(product) {
            var image = product.image ? '/storage/images/product/' + product.image : '/client/img/product/1.jpg';
            var description = (product.description || '').length > 70 ? (product.description || '').substring(0, 70) + '…' : (product.description || '');
            var name = esc(product.name);
            return '<div class="col-lg-4 col-md-6">' +
                '<div class="product-item ecom-product-card">' +
                    '<div class="product-img">' +
                        '<a href="/single_product/' + product.id + '"><img src="' + image + '" alt="' + name + '" loading="lazy" decoding="async"></a>' +
                        '<span class="ecom-badge">' + esc(product.product_list || 'New arrival') + '</span>' +
                        '<button type="button" class="ecom-wish" data-product-id="' + product.id + '" onclick="ecomToggleWishlist(' + product.id + ', this)" title="Add to wish list" aria-label="Add to wish list">' +
                            '<i class="zmdi zmdi-favorite" aria-hidden="true"></i>' +
                        '</button>' +
                    '</div>' +
                    '<div class="product-info">' +
                        '<h6 class="product-title"><a href="/single_product/' + product.id + '">' + name + '</a></h6>' +
                        '<p class="pro-rating" aria-label="Rated 4 and a half stars out of 5">' +
                            '<span class="rate-icons" aria-hidden="true">' +
                                '<i class="zmdi zmdi-star"></i><i class="zmdi zmdi-star"></i><i class="zmdi zmdi-star"></i><i class="zmdi zmdi-star-half"></i><i class="zmdi zmdi-star-outline"></i>' +
                            '</span>' +
                        '</p>' +
                        '<h3 class="pro-price">$' + Number(product.price).toFixed(2) + '</h3>' +
                        '<p class="ecom-product-desc">' + esc(description) + '</p>' +
                        '<div class="ecom-card-actions">' +
                            '<button type="button" class="ecom-btn-add" onclick="ecomAddToCart(' + product.id + ')">' +
                                '<i class="zmdi zmdi-shopping-cart-plus" aria-hidden="true"></i> Add to cart' +
                            '</button>' +
                            '<button type="button" class="ecom-btn-buy" onclick="ecomBuyNow(' + product.id + ')">Buy now</button>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>';
        }

        function renderProducts(products) {
            var container = $('#product-container');
            container.empty();

            if (!products || products.length === 0) {
                container.html('<div class="col-12"><div class="empty-cart box-shadow p-60 text-center">' +
                    '<h2 class="mb-20">No products found</h2>' +
                    '<p>Try a different category or clear your search.</p></div></div>');
                $('#showing-count').text('0 products');
                return;
            }

            $.each(products, function (index, product) {
                container.append(productCardHtml(product));
            });

            $('#showing-count').text(products.length + ' product' + (products.length === 1 ? '' : 's'));
        }

        function fetchProductss(categoryId) {
            categoryId = categoryId || '';

            var params = new URLSearchParams(window.location.search);
            if (categoryId) { params.set('category', categoryId); } else { params.delete('category'); }
            var query = params.toString();
            var url = '/shop' + (query ? '?' + query : '');

            window.history.replaceState({}, '', url.length > '/shop'.length ? url : '/shop');

            if (categoryId) {
                $.ajax({
                    url: '/get-products-by-category/' + categoryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        shopProducts = response.products || [];
                        renderProducts(applySearch(shopProducts));
                    },
                    error: function (error) {
                        console.error('Error fetching products:', error);
                        renderProducts(shopProducts);
                    }
                });
            } else {
                renderProducts(applySearch(shopProducts));
            }
        }

        function applySearch(products) {
            var term = ($('#shop-search').val() || '').trim().toLowerCase();
            if (!term) { return products; }
            return products.filter(function (product) {
                return (product.name || '').toLowerCase().indexOf(term) !== -1 ||
                       (product.description || '').toLowerCase().indexOf(term) !== -1;
            });
        }

        $('#shop-search').on('input', function () {
            renderProducts(applySearch(shopProducts));
        });

        $('#shop-search').closest('form').on('submit', function (e) {
            e.preventDefault();
            renderProducts(applySearch(shopProducts));
        });

        window.fetchProductss = fetchProductss;

        // Keep the view in sync with the URL on load (?category=…&q=…)
        var initialCategory = new URLSearchParams(window.location.search).get('category');
        if (initialCategory) {
            $.ajax({
                url: '/get-products-by-category/' + encodeURIComponent(initialCategory),
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    shopProducts = response.products || [];
                    renderProducts(applySearch(shopProducts));
                }
            });
        }
    });
</script>

@endsection
