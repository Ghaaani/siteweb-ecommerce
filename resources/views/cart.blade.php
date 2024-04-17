@extends('client.layouts.app')

@section('content')

        <!-- Start page content -->
        <section id="page-content" class="page-wrapper section">

            <!-- SHOP SECTION START -->
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2">
                            <ul class="nav cart-tab">
                                <li>
                                    <a class="active">
                                        <span>01</span>
                                        Shopping cart
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span>02</span>
                                        Checkout
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span>03</span>
                                        Order complete
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-10">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- shopping-cart start -->
                                <div class="tab-pane active" id="shopping-cart">
                                    <div class="shopping-cart-content">
                                        <form action="#">
                                            <div class="table-content table-responsive mb-50">
                                                <table class="text-center">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-thumbnail">product</th>
                                                            <th class="product-price">price</th>
                                                            <th class="product-quantity">Quantity</th>
                                                            <th class="product-subtotal">total</th>
                                                            <th class="product-remove">remove</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="product-container">

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <div class="payment-details box-shadow p-30 mb-50">
                                                        <h6 class="widget-title border-left mb-20">payment details</h6>
                                                        <table>
                                                            <tr>
                                                                <td class="td-title-1">Cart Subtotal</td>
                                                                <td class="td-title-2">$155.00</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="td-title-1">Shipping and Handing</td>
                                                                <td class="td-title-2">$15.00</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="td-title-1">Vat</td>
                                                                <td class="td-title-2">$00.00</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="order-total">Order Total</td>
                                                                <td class="order-total-price">$170.00</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">

                                                        <div class="row">

                                                            <div class="col-md-12">
                                                                <button class="submit-btn-1 black-bg btn-hover-2">Checkout</button>   
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SHOP SECTION END -->             

        </section>
        <!-- End page content -->

<script>

$(document).ready(function() {
    // Fetch products using AJAX
    $.ajax({
        url: '/cart',  // Update this to the URL associated with your index method
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

    function displayProducts(products) {
    var productContainer = $('#product-container');

    // Clear previous products
    productContainer.empty();
    

    $.each(products, function(index, product) {
        var productItem = $('<tr>' +
                                '<td class="product-thumbnail">' +
                                    '<div class="pro-thumbnail-img">' +
                                        '<img src="' + product.image + '" alt="" />' +
                                    '</div>' +
                                    '<div class="pro-thumbnail-info text-start">' +
                                        '<h6 class="product-title-2">' +
                                            '<a href="#">' + product.name + '</a>' +
                                        '</h6>' +
                                    '</div>' +
                                '</td>' +
                                '<td class="product-price">' + product.prix + '</td>' +
                                '<td class="product-quantity">' +
                                    '<div class="cart-plus-minus f-left">' +
                                        '<div class="dec qtybutton"><button onclick="decQuantity('+ product.id +')">-</button></div>'+
                                            '<input type="text" value=" ' + product.quantity + ' " name="qtybutton" class="cart-plus-minus-box" data-product-id="' + product.id + '" disabled>'+
                                        '<div class="inc qtybutton"><button onclick="incQuantity('+ product.id +')">+</button></div>' +
                                    '</div>' +
                                '</td>' +
                                '<td class="product-subtotal">$1020.00</td>' +
                                '<td class="product-remove">' +
                                    '<a href="#"><i class="zmdi zmdi-close"></i></a>' +
                                '</td>' +
                            '</tr>');

        productContainer.append(productItem);
    });
}
});


// Function to update product quantity in the database via AJAX
function incQuantity(productId) {
    console.log(productId);
    $.ajax({
        url: 'inc-quantity/' + productId,
        type: 'GET',
        data: {
            pId: productId
        },
        success: function(response) { 
            // Increment the input number with class '.cart-plus-minus-box' by 1
            var $input = $('.cart-plus-minus-box[data-product-id="' + productId + '"]');
            var newValue = parseInt($input.val()) + 1;
            $input.val(newValue);
        }, 
        error: function(error) { 
            console.error('Error updating product quantity:', error);
        } 
    });
}

function decQuantity(newQuantity) {
    $.ajax({
        url: '/update-product-quantity/' + productId,
        type: 'POST',
        data: { quantity: newQuantity },
        success: function(response) {
            // Handle success response
        },
        error: function(error) {
            console.error('Error updating product quantity:', error);
        }
    });
}

</script>

@endsection