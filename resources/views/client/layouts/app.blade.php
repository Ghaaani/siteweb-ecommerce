<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Imagin Creative</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('client/img/logo/logo.png')}}">

    <!-- All CSS Files -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="{{ asset('client/css/bootstrap.min.css' )}}">
    <!-- Nivo-slider css -->
    <link rel="stylesheet" href="{{ asset('client/lib/css/nivo-slider.css' )}}">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="{{ asset('client/css/core.css' )}}">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="{{ asset('client/css/shortcode/shortcodes.css' )}}">
    <!-- Main site color style -->
    <!-- Theme main style -->
    <link rel="stylesheet" href="{{ asset('client/css/style.css' )}}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('client/css/responsive.css' )}}">
    <!-- User style -->
    <link rel="stylesheet" href="{{ asset('client/css/custom.css' )}}">
    
    <!-- Style customizer (Remove these two lines please) -->
    <link rel="stylesheet" href="{{ asset('client/css/style-customizer.css' )}}">
    <link href="#" data-style="styles" rel="stylesheet">

    <!-- Modernizr JS -->
    <script src="{{ asset('client/js/vendor/modernizr-3.11.2.min.js' )}}"></script>

    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">


        <!-- START HEADER AREA -->
        <header class="header-area header-wrapper ">
            <!-- header-middle-area -->
            <div id="sticky-header" class="header-middle-area plr-185">
                <div class="container-fluid">
                    <div class="full-width-mega-dropdown">
                        <div class="row">
                            <!-- logo -->
                            <div class="col-lg-2 col-md-4">
                                <div class="logo">
                                    <a href="/index">
                                        <img src="{{ asset('client/img/logo/logo.png')}}" alt="main logo">
                                    </a>
                                </div>
                            </div>
                            <!-- primary-menu -->
                            <div class="col-lg-8 d-none d-lg-block">
                                <nav id="primary-menu">
                                    <ul class="main-menu text-center">
                                        <li><a href="/index">Home</a>                                           
                                                    <a href="/index"></a>
                                        </li>
                                        
                                        <li><a href="/shop">Products</a>
                                        </li>
                                        
                                        <li>
                                            <a href="/about">About us</a>
                                        </li>

                                        <li>
                                            <a href="/contact">Contact</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- header-search & total-cart -->
                            <div class="col-lg-2 col-md-8">
                                <div class="search-top-cart  f-right">
                                    <!-- header-search -->
                                    <div class="header-search header-search-2 f-left">
                                        <div class="header-search-inner">
                                           <button class="search-toggle">
                                            <i class="zmdi zmdi-search"></i>
                                           </button>
                                            <form action="#">
                                                <div class="top-search-box">
                                                    <input type="text" placeholder="Search here your product...">
                                                    <button type="submit">
                                                        <i class="zmdi zmdi-search"></i>
                                                    </button>
                                                </div>
                                            </form> 
                                        </div>
                                    </div>
                                    <div class="header-account header-account-2 f-left">
                                        <ul class="user-meta">
                                            <li><a href="#"><i class="zmdi zmdi-view-headline"></i></a>
                                                <ul>
                                                    <li><a href="#">My Account</a></li>
                                                    <li><a href="/wishlist">Wish list</a></li>
                                                    <li><a href="/checkout">Checkout</a></li>
                                                    <li><a href="#">Log in</a></li>        
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- total-cart -->
                                    <div class="total-cart total-cart-2 f-left">
                                        <div class="total-cart-in">

                                            <div class="cart-toggler">

                                                @php
                                                    $nb = $number->count();
                                                @endphp

                                                <a href="#">
                                                    <span class="cart-quantity">{{$nb}}</span><br>
                                                    <span class="cart-icon">
                                                        <i class="zmdi zmdi-shopping-cart-plus"></i>
                                                    </span>
                                                </a>                            
                                            </div>

                                            <ul>

                                                <li>
                                                    <div class="top-cart-inner your-cart">
                                                        <h5 class="text-capitalize">Your Cart</h5>
                                                    </div>
                                                </li>
                                                
                                                <li>
                                                    <div class="total-cart-pro">
                                                    @foreach ($carts as $cart)
                                                        <!-- single-cart -->
                                                        <div class="single-cart clearfix">
                                                            <div class="cart-img f-left">
                                                                <a href="#">
                                                                    <img src="{{ asset('client/img/cart/1.jpg')}}" alt="Cart Product" />
                                                                </a>
                                                                <div class="del-icon">
                                                                    <button onclick="Remove({{ $cart->id }})">><a href="#"><i class="zmdi zmdi-close"></i></a></button>
                                                                </div>
                                                            </div>
                                                            <div class="cart-info f-left">
                                                                <h6 class="text-capitalize">
                                                                    <a href="#">{{$cart->name}}</a>
                                                                </h6>
                                                                <p>
                                                                    <span>Prix <strong>:</strong></span>{{$cart->prix}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <!-- single-cart -->
                                                    @endforeach
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="top-cart-inner subtotal">
                                                    <h4 class="text-uppercase g-font-2"> 
                                                        Total  =  
                                                        <span>

                                                            @php
                                                                $totalPrice = 0;
                                                                foreach ($number as $item) {
                                                                $totalPrice += $item->prix;
                                                                }
                                                                echo $totalPrice;
                                                            @endphp

                                                    </span>
                                                </h4>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="top-cart-inner view-cart">
                                                        <h4 class="text-uppercase">
                                                            <a href="/cart">View cart</a>
                                                        </h4>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="top-cart-inner check-out">
                                                        <h4 class="text-uppercase">
                                                            <a href="/checkout">Check out</a>
                                                        </h4>
                                                    </div>
                                                </li>

                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER AREA -->

        <!-- START SLIDER AREA -->
        


 




        @yield('content')






        <!-- START FOOTER AREA -->
        <footer id="footer" class="footer-area footer-2 section">
            <div class="footer-top footer-top-2 text-center ptb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer-logo">
                                <img src="{{asset('client/img/logo/logo.png' )}}" alt="Logo">
                            </div>
                            <ul class="footer-menu-2">
                                <li><a href="/index">Home</a></li>
                                <li><a href="/shop">Products</a></li>
                                <li><a href="/about">About us</a></li>
                                <li><a href="/contact">Contact</a></li>
                            </ul>                                                  
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom footer-bottom-2 text-center gray-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <ul class="footer-social footer-social-2">
                                <li>
                                    <a class="facebook" href="#" title="Facebook"><i class="zmdi zmdi-facebook"></i></a>
                                </li>
                                <li>
                                    <a class="google-plus" href="#" title="Google Plus"><i class="zmdi zmdi-google-plus"></i></a>
                                </li>
                                <li>
                                    <a class="twitter" href="#" title="Twitter"><i class="zmdi zmdi-twitter"></i></a>
                                </li>
                                <li>
                                    <a class="rss" href="#" title="RSS"><i class="zmdi zmdi-rss"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <ul class="footer-payment">
                                <li>
                                    <a href="#"><img src="{{asset('client/img/payment/1.jpg' )}}" alt="" /></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{asset('client/img/payment/2.jpg' )}}" alt="" /></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{asset('client/img/payment/3.jpg' )}}" alt="" /></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{asset('client/img/payment/4.jpg' )}}" alt="" /></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END FOOTER AREA -->

        <!-- START QUICKVIEW PRODUCT -->
        <div id="quickview-wrapper">
            <!-- Modal -->
            <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-product clearfix">
                                <div class="product-images">
                                    <div class="main-image images">
                                        <img alt="" src="{{asset('client/img/product/quickview.jpg' )}}">
                                    </div>
                                </div><!-- .product-images -->
                                
                                <div class="product-info">
                                    <h1>Aenean eu tristique</h1>
                                    <div class="price-box-3">
                                        <div class="s-price-box">
                                            <span class="new-price">£160.00</span>
                                            <span class="old-price">£190.00</span>
                                        </div>
                                    </div>
                                    <a href="/shop" class="see-all">See all features</a>
                                    <div class="quick-add-to-cart">
                                        <form method="post" class="cart">
                                            <div class="numbers-row">
                                                <input type="number" id="french-hens" value="3" min="1">
                                            </div>
                                            <button class="single_add_to_cart_button" type="submit">Add to cart</button>
                                        </form>
                                    </div>
                                    <div class="quick-desc">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero.
                                    </div>
                                    <div class="social-sharing">
                                        <div class="widget widget_socialsharing_widget">
                                            <h3 class="widget-title-modal">Share this product</h3>
                                            <ul class="social-icons clearfix">
                                                <li>
                                                    <a class="facebook" href="#" target="_blank" title="Facebook">
                                                        <i class="zmdi zmdi-facebook"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="google-plus" href="#" target="_blank" title="Google +">
                                                        <i class="zmdi zmdi-google-plus"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="twitter" href="#" target="_blank" title="Twitter">
                                                        <i class="zmdi zmdi-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="pinterest" href="#" target="_blank" title="Pinterest">
                                                        <i class="zmdi zmdi-pinterest"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="rss" href="#" target="_blank" title="RSS">
                                                        <i class="zmdi zmdi-rss"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- .product-info -->
                            </div><!-- .modal-product -->
                        </div><!-- .modal-body -->
                    </div><!-- .modal-content -->
                </div><!-- .modal-dialog -->
            </div>
            <!-- END Modal -->
        </div>
        <!-- END QUICKVIEW PRODUCT -->    


    <!-- Placed JS at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <script src="{{ asset('client/js/vendor/jquery-3.6.0.min.js' )}}"></script>
    <script src="{{ asset('client/js/vendor/jquery-migrate-3.3.2.min.js' )}}"></script>
    <!-- Bootstrap framework js -->
    <script src="{{ asset('client/js/bootstrap.bundle.min.js' )}}"></script>
    <!-- jquery.nivo.slider js -->
    <script src="{{ asset('client/lib/js/jquery.nivo.slider.js' )}}"></script>
    <!-- All js plugins included in this file. -->
    <script src="{{ asset('client/js/plugins.js' )}}"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="{{ asset('client/js/main.js' )}}"></script>

    <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js' )}}"></script>

    <script>

        function Remove(id) {
        var url ='remove-product/' + id;

        // Fetch products using AJAX
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response.products);
            },
            error: function(error) {
                console.error('Error fetching products:', error);
            }
        });
    }


    </script>


</body>

</html>