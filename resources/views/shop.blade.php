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
                                            <a class="active" href="#grid-view" data-bs-toggle="tab"><i
                                                    class="zmdi zmdi-view-module"></i></a>
                                        </li>
                                        <li>
                                            <a href="#list-view" data-bs-toggle="tab"><i class="zmdi zmdi-view-list-alt"></i></a>
                                        </li>
                                    </ul>

                                    <!-- showing -->
                                    <div class="showing f-right text-end">
                                        <span>Showing : 01-09 of 17.</span>
                                    </div>
                                </div>
                                <!-- shop-option end -->
                                <!-- Tab Content start -->
                                <div class="tab-content">
                                    <!-- grid-view -->
                                    <div id="grid-view" class="tab-pane active show" role="tabpanel">

                                        <div class="row"  id="product-container">
                                            <!-- product-item start -->
                                            

                                            <!-- product-item end -->
                                        </div>
                                    </div>
                                    <div id="list-view" class="tab-pane" role="tabpanel">
                                        <div class="row" id="product-list">
                                            <!-- product-item start -->
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- Tab Content end -->
                                <!-- shop-pagination start -->
                                <ul class="shop-pagination box-shadow text-center ptblr-10-30">
                                    <li><a href="#"><i class="zmdi zmdi-chevron-left"></i></a></li>
                                    <li><a href="#">01</a></li>
                                    <li><a href="#">02</a></li>
                                    <li><a href="#">03</a></li>
                                    <li><a href="#">...</a></li>
                                    <li><a href="#">05</a></li>
                                    <li class="active"><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
                                </ul>
                                <!-- shop-pagination end -->
                            </div>
                        </div>
                        <div class="col-lg-3 order-lg-1 order-2">
                            <!-- widget-search -->
                            <aside class="widget-search mb-30">
                                <form action="#">
                                    <input type="text" placeholder="Search here...">
                                    <button type="submit"><i class="zmdi zmdi-search"></i></button>
                                </form>
                            </aside>
                            <!-- widget-categories -->
                            <aside class="widget widget-categories box-shadow mb-30">
                                <h6 class="widget-title border-left mb-20">Categories</h6>
                                <div id="category-buttons" class="product-cat">
                                   
                                        <ul>
                                             @foreach ($categories as $categorie)
                                                <li ><button class="category-btn" data-id="{{ $categorie->id }}" onclick="fetchProductss({{ $categorie->id }})">{{ $categorie->name }}</button></li>
                                            @endforeach 
                                        </ul>
                                    
                                </div>
                            </aside>

                            <!-- shop-filter
                            <aside class="widget shop-filter box-shadow mb-30">
                                <h6 class="widget-title border-left mb-20">Price</h6>
                                <div class="price_filter">
                                    <div class="price_slider_amount">
                                        <input type="submit" value="You range :" />
                                        <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                    </div>
                                    <div id="slider-range"></div>
                                </div>
                            </aside> -->
                            <!-- widget-color -->
                    
                        </div>
                    </div>
                </div>
            </div>
            <!-- SHOP SECTION END -->
        
        </div>
        <!-- End page content -->




<script>
$(document).ready(function() {
    // Fetch products using AJAX
    $.ajax({
        url: '/shop',  // Update this to the URL associated with your index method
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Handle the JSON response and display products
            displayProducts(response.products);
        },
        error: function(error) {
            console.error('Error fetching products:', error);
        }
    });

    // Function to display products
    function displayProducts(products) {

        var productContainer = $('#product-container');

        // Iterate through products and append them to the container
        $.each(products, function(index, product) {
            var productItem = $('<div class="col-lg-4 col-md-6">' +
                                    '<div class="product-item">' +
                                        '<div class="product-img">' +
                                            '<a href="single-product.html">' +
                                            '<img src="/storage/images/product/' + product.image + '" />' +
                                            '</a>' +
                                        '</div>' +
                                        '<div class="product-info">' +
                                            '<h6 class="product-title">' +
                                                '<a href="single-product.html">' + product.name + '</a>' +
                                            '</h6>' +
                                            '<div class="pro-rating">' +
                                                '<a href="#"><i class="zmdi zmdi-star"></i></a>' +
                                                '<a href="#"><i class="zmdi zmdi-star"></i></a>' +
                                                '<a href="#"><i class="zmdi zmdi-star"></i></a>' +
                                                '<a href="#"><i class="zmdi zmdi-star-half"></i></a>' +
                                                '<a href="#"><i class="zmdi zmdi-star-outline"></i></a>' +
                                            '</div>' +
                                            '<h3 class="pro-price"> ' + product.price + 'DHs </h3>' +
                                            '<ul class="action-button">' +
                                                '<li>' +
                                                    '<a href="#" title="Wishlist"><i class="zmdi zmdi-favorite"></i></a>' +
                                                '</li>' +
                                                '<li>' +
                                                    '<a href="#" data-bs-toggle="modal" data-bs-target="#productModal" title="Quickview"><i class="zmdi zmdi-zoom-in"></i></a>' +
                                                '</li>' +
                                                '<li>' +
                                                    '<a href="#" title="Compare"><i class="zmdi zmdi-refresh"></i></a>' +
                                                '</li>' +
                                                '<li>' +
                                                    '<button onclick="Add(' + product.id + ')"><a href="#" title="Add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a></button>' +
                                                '</li>' +
                                            '</ul>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>');

            // Append the product item to the container
            productContainer.append(productItem);
        })
        
        var productList = $('#product-list');

        // Clear previous products
        productList.empty();

        // Iterate through products and append them to the container
        $.each(products, function(index, product) {
            var productItem = $('<div class="col-lg-12">' +
                                    '<div class="shop-list product-item">' +
                                        '<div class="product-img">' +
                                            '<a href="single-product.html">' +
                                            '<img src="/storage/images/product/' + product.image + '" />' +
                                            '</a>' +
                                        '</div>' +
                                        '<div class="product-info">' +
                                            '<div class="clearfix">' +
                                                '<h6 class="product-title f-left">' +
                                                    '<a href="single-product.html">' + product.name + '</a>' +
                                                '</h6>' +
                                                '<div class="pro-rating f-right">' +
                                                    '<a href="#"><i class="zmdi zmdi-star"></i></a>' +
                                                    '<a href="#"><i class="zmdi zmdi-star"></i></a>' +
                                                    '<a href="#"><i class="zmdi zmdi-star"></i></a>' +
                                                    '<a href="#"><i class="zmdi zmdi-star-half"></i></a>' +
                                                    '<a href="#"><i class="zmdi zmdi-star-outline"></i></a>' +
                                                '</div>' +
                                            '</div>' +
                                            '<h6 class="brand-name mb-30">Brand Name</h6>' +
                                            '<h3 class="pro-price"> ' + product.price + 'DHs </h3>' +
                                            '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.</p>' +
                                            '<ul class="action-button">' +
                                                '<li>' +
                                                    '<a href="#" title="Wishlist"><i class="zmdi zmdi-favorite"></i></a>' +
                                                '</li>' +
                                                '<li>' +
                                                    '<a href="#" data-bs-toggle="modal" data-bs-target="#productModal" title="Quickview"><i class="zmdi zmdi-zoom-in"></i></a>' +
                                                '</li>' +
                                                '<li>' +
                                                    '<a href="#" title="Compare"><i class="zmdi zmdi-refresh"></i></a>' +
                                                '</li>' +
                                                '<li>' +
                                                    '<button onclick="Add(' + product.id + ')"><a href="#" title="Add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a></button>' +
                                                '</li>' +
                                            '</ul>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>'
                                );

            // Append the product item to the container
            productList.append(productItem);
        });
    }

    
});

function fetchProductss(categoryId) {
    console.log(categoryId);
        var url = categoryId ? 'get-products-by-category/' + categoryId : '/shop';

        // Fetch products using AJAX
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Handle the JSON response and display products
                displayProductss(response.products);
            },
            error: function(error) {
                console.error('Error fetching products:', error);
            }
        });
}

    // Function to display products
    function displayProductss(products) {
        var productContainer = $('#product-container');
        
        // Clear previous products
        productContainer.empty();

        // Iterate through products and append them to the container
        $.each(products, function(index, product) {
            var productItem = $('<div class="col-lg-4 col-md-6">' +
                                    '<div class="product-item">' +
                                        '<div class="product-img">' +
                                            '<a href="single-product.html">' +
                                            '<img src="/storage/images/product/' + product.image + '" />' +
                                            '</a>' +
                                        '</div>' +
                                        '<div class="product-info">' +
                                            '<h6 class="product-title">' +
                                                '<a href="single-product.html">' + product.name + '</a>' +
                                            '</h6>' +
                                            '<div class="pro-rating">' +
                                                '<a href="#"><i class="zmdi zmdi-star"></i></a>' +
                                                '<a href="#"><i class="zmdi zmdi-star"></i></a>' +
                                                '<a href="#"><i class="zmdi zmdi-star"></i></a>' +
                                                '<a href="#"><i class="zmdi zmdi-star-half"></i></a>' +
                                                '<a href="#"><i class="zmdi zmdi-star-outline"></i></a>' +
                                            '</div>' +
                                            '<h3 class="pro-price"> ' + product.price + 'DHs </h3>' +
                                            '<ul class="action-button">' +
                                                '<li>' +
                                                    '<button><a href="#" title="Wishlist"><i class="zmdi zmdi-favorite"></i></a></button>' +
                                                '</li>' +
                                                '<li>' +
                                                    '<button><a href="#" data-bs-toggle="modal" data-bs-target="#productModal" title="Quickview"><i class="zmdi zmdi-zoom-in"></i></a></button>' +
                                                '</li>' +
                                                '<li>' +
                                                    '<button><a href="#" title="Compare"><i class="zmdi zmdi-refresh"></i></a></button>' +
                                                '</li>' +
                                                '<li>' +
                                                    '<button onclick="Add(' + product.id + ')"><a href="#" title="Add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a></button>' +
                                                '</li>' +
                                            '</ul>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>');
            productContainer.append(productItem);
        });
    }

    // function Add(productId) {
    //     var url ='insert-Poduct/' + productId;
    //     var cartQuantityText = document.querySelector('.cart-quantity').textContent;
    //     var cartQuantityNumber = parseFloat(cartQuantityText);


        
    //     // Fetch products using AJAX
    //     $.ajax({
    //         url: url,
    //         type: 'GET',
    //         dataType: 'json',

    //         success: function(response) {
    //             cartQuantityNumber ++;
    //             console.log(cartQuantityNumber);            
    //         },      
    //         error: function(error) {
    //             console.error('Error fetching products:', error);
    //         }

    //     });
    // }


    function Add(productId) {
    var url = 'insert-Poduct/' + productId;
    var cartQuantityElement = document.querySelector('.cart-quantity');

    // Fetch products using AJAX
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',

        success: function(response) {
            // Increment the cart quantity number
            var cartQuantityText = cartQuantityElement.textContent;
            var cartQuantityNumber = parseFloat(cartQuantityText);
            cartQuantityNumber++;
            console.log(cartQuantityNumber);

            // Update the cart quantity element with the new value
            cartQuantityElement.textContent = cartQuantityNumber;
        },

        error: function(error) {
            console.error('Error fetching products:', error);
        }

    });
}

</script>


@endsection