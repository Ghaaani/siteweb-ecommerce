@extends('client.layouts.app')

@section('content')


        <!-- Start page content -->
        <div id="page-content" class="page-wrapper section">

            <!-- SHOP SECTION START -->
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 order-lg-2 order-1">
                            <div class="shop-content">
                                <!-- shop-option start -->
                                <div class="shop-option box-shadow mb-30 clearfix">
                                    <!-- Nav tabs -->
                                    <ul class="nav shop-tab f-left" role="tablist">
                                        <li>
                                            <a class="active" href="#grid-view" data-bs-toggle="tab"><i class="zmdi zmdi-view-module"></i></a>
                                        </li>
                                        <li>
                                            <a href="#list-view" data-bs-toggle="tab"><i class="zmdi zmdi-view-list-alt"></i></a>
                                        </li>
                                    </ul>

                                    <!-- showing -->
                                    <div class="showing f-right text-end">
                                        <span id="showing-count">Showing : {{ $productss->count() }} products.</span>
                                    </div>
                                </div>
                                <!-- shop-option end -->
                                <!-- Tab Content start -->
                                <div class="tab-content">
                                    <!-- grid-view -->
                                    <div id="grid-view" class="tab-pane active show" role="tabpanel">
                                        <div class="row" id="product-container">
                                            @forelse($productss as $product)
                                                <div class="col-lg-4 col-md-6">
                                                    @include('client.partials.product-card', ['product' => $product])
                                                </div>
                                            @empty
                                                <div class="col-12">
                                                    <div class="empty-cart box-shadow p-60 text-center">
                                                        <h4 class="mb-20">No products yet</h4>
                                                        <p>Products added from the admin area will show up here.</p>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <!-- Tab Content end -->
                            </div>
                        </div>
                        <div class="col-lg-3 order-lg-1 order-2">
                            <!-- widget-search -->
                            <aside class="widget-search mb-30">
                                <form action="#" onsubmit="return false;">
                                    <input type="text" id="shop-search" placeholder="Search here...">
                                    <button type="submit" id="shop-search-btn"><i class="zmdi zmdi-search"></i></button>
                                </form>
                            </aside>
                            <!-- widget-categories -->
                            <aside class="widget widget-categories box-shadow mb-30">
                                <h6 class="widget-title border-left mb-20">Categories</h6>
                                <div id="category-buttons" class="product-cat">
                                    <ul>
                                        <li>
                                            <button class="category-btn active" data-id="" onclick="fetchProductss('')">All products</button>
                                        </li>
                                        @foreach ($categories as $categorie)
                                            <li>
                                                <button class="category-btn" data-id="{{ $categorie->id }}" onclick="fetchProductss({{ $categorie->id }})">{{ $categorie->name }}</button>
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
    var shopProducts = @json($productss);

    function productCardHtml(product) {
        var image = product.image ? '/storage/images/product/' + product.image : '/client/img/product/1.jpg';
        var description = (product.description || '').length > 70 ? (product.description || '').substring(0, 70) + '…' : (product.description || '');
        return '<div class="col-lg-4 col-md-6">' +
            '<div class="product-item ecom-product-card">' +
                '<div class="product-img">' +
                    '<a href="/single_product/' + product.id + '"><img src="' + image + '" alt="' + product.name + '"></a>' +
                    '<span class="ecom-badge">' + (product.product_list || 'New arrival') + '</span>' +
                    '<button type="button" class="ecom-wish" data-product-id="' + product.id + '" onclick="ecomToggleWishlist(' + product.id + ', this)" title="Add to wish list" aria-label="Add to wish list">' +
                        '<i class="zmdi zmdi-favorite-outline"></i>' +
                    '</button>' +
                '</div>' +
                '<div class="product-info">' +
                    '<h6 class="product-title"><a href="/single_product/' + product.id + '">' + product.name + '</a></h6>' +
                    '<div class="pro-rating">' +
                        '<a href="#" onclick="return false;"><i class="zmdi zmdi-star"></i></a>' +
                        '<a href="#" onclick="return false;"><i class="zmdi zmdi-star"></i></a>' +
                        '<a href="#" onclick="return false;"><i class="zmdi zmdi-star"></i></a>' +
                        '<a href="#" onclick="return false;"><i class="zmdi zmdi-star-half"></i></a>' +
                        '<a href="#" onclick="return false;"><i class="zmdi zmdi-star-outline"></i></a>' +
                    '</div>' +
                    '<h3 class="pro-price">$' + Number(product.price).toFixed(2) + '</h3>' +
                    '<p class="ecom-product-desc">' + description + '</p>' +
                    '<div class="ecom-card-actions">' +
                        '<button type="button" class="ecom-btn-add" onclick="ecomAddToCart(' + product.id + ')">' +
                            '<i class="zmdi zmdi-shopping-cart-plus"></i> Add to cart' +
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
                '<h4 class="mb-20">No products found</h4>' +
                '<p>Try a different category or clear your search.</p></div></div>');
            $('#showing-count').text('Showing : 0 products.');
            return;
        }

        $.each(products, function (index, product) {
            container.append(productCardHtml(product));
        });

        $('#showing-count').text('Showing : ' + products.length + ' product' + (products.length === 1 ? '' : 's') + '.');
    }

    function fetchProductss(categoryId) {
        var url = categoryId ? '/get-products-by-category/' + categoryId : '/shop';

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                shopProducts = response.products || [];
                renderProducts(shopProducts);
            },
            error: function (error) {
                console.error('Error fetching products:', error);
            }
        });
    }

    $('#shop-search-btn').on('click', function () {
        var term = ($('#shop-search').val() || '').toLowerCase();
        if (!term) {
            renderProducts(shopProducts);
            return;
        }
        renderProducts(shopProducts.filter(function (product) {
            return (product.name || '').toLowerCase().indexOf(term) !== -1 ||
                   (product.description || '').toLowerCase().indexOf(term) !== -1;
        }));
    });

    $('#shop-search').on('keyup', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            $('#shop-search-btn').trigger('click');
        }
    });

    $('.category-btn').on('click', function () {
        $('.category-btn').removeClass('active');
        $(this).addClass('active');
    });
</script>

@endsection
