<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>@hasSection('title') @yield('title') · {{ config('app.name') }} @else {{ config('app.name') }} @endif</title>
    @hasSection('meta')
        <meta name="description" content="@yield('meta')">
    @else
        <meta name="description" content="Hand-picked pieces at honest prices, with free delivery on every order. Order in a couple of clicks with your card or PayPal.">
    @endif
    <meta name="theme-color" content="#faf8f4">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('client/img/logo/logo.png')}}">

    <!-- Google Fonts (consolidated: every family actually used) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Raleway:400,500,600,700&family=Roboto:400,500,700&display=swap" rel="stylesheet">

    <!-- All CSS Files -->
    <!-- Bootstrap framework main css -->
    <link rel="stylesheet" href="{{ asset('client/css/bootstrap.min.css' )}}">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="{{ asset('client/css/core.css' )}}">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="{{ asset('client/css/shortcode/shortcodes.css' )}}">
    <!-- Theme main style -->
    <link rel="stylesheet" href="{{ asset('client/css/style.css' )}}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('client/css/responsive.css' )}}">
    <!-- User style -->
    <link rel="stylesheet" href="{{ asset('client/css/custom.css' )}}">
</head>

<body>
    <a class="ecom-skip-link" href="#main-content">Skip to content</a>
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
                                        <li><a href="/index">Home</a></li>
                                        <li><a href="/shop">Products</a></li>
                                        <li><a href="/about">About us</a></li>
                                        <li><a href="/contact">Contact</a></li>
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
                                            <li>
                                                <a href="/login"><i class="zmdi zmdi-view-headline"></i></a>
                                                <ul>
                                                    @auth
                                                        <li><a href="/account">My account</a></li>
                                                        <li><a href="/account">My orders</a></li>
                                                    @endauth
                                                    <li><a href="/wishlist">Wish list</a></li>
                                                    <li><a href="/checkout">Checkout</a></li>
                                                    @auth
                                                        <li>
                                                            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                                                                <button type="submit" class="ecom-logout-link">Log out</button>
                                                            </form>
                                                        </li>
                                                    @else
                                                        <li><a href="/login">Log in</a></li>
                                                        <li><a href="/register">Create account</a></li>
                                                    @endauth
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

                                                <a href="/cart">
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
                                                                <a href="/single_product/{{ $cart->product_id }}">
                                                                    <img src="{{ $cart->image ? asset('storage/images/product/'.$cart->image) : asset('client/img/cart/1.jpg') }}" alt="{{ $cart->name }}" />
                                                                </a>
                                                                <div class="del-icon">
                                                                    <button type="button" title="Remove" onclick="ecomRemoveFromCart({{ $cart->id }})"><i class="zmdi zmdi-close"></i></button>
                                                                </div>
                                                            </div>
                                                            <div class="cart-info f-left">
                                                                <h6 class="text-capitalize">
                                                                    <a href="/single_product/{{ $cart->product_id }}">{{$cart->name}}</a>
                                                                </h6>
                                                                <p>
                                                                    <span>Prix <strong>:</strong></span>{{$cart->prix}} × {{$cart->quantity}}
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
                                                                $totalPrice += ($item->prix * $item->quantity);
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
        


 




        <main id="main-content" class="ecom-main">

        @yield('content')

        </main>
        <!-- END MAIN CONTENT -->






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
                                    <span class="facebook" aria-hidden="true"><i class="zmdi zmdi-facebook"></i></span>
                                </li>
                                <li>
                                    <span class="google-plus" aria-hidden="true"><i class="zmdi zmdi-google-plus"></i></span>
                                </li>
                                <li>
                                    <span class="twitter" aria-hidden="true"><i class="zmdi zmdi-twitter"></i></span>
                                </li>
                                <li>
                                    <span class="rss" aria-hidden="true"><i class="zmdi zmdi-rss"></i></span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <ul class="footer-payment">
                                <li><img src="{{asset('client/img/payment/1.jpg' )}}" alt="Visa accepted" width="45" height="30" loading="lazy" decoding="async"></li>
                                <li><img src="{{asset('client/img/payment/2.jpg' )}}" alt="Mastercard accepted" width="45" height="30" loading="lazy" decoding="async"></li>
                                <li><img src="{{asset('client/img/payment/3.jpg' )}}" alt="PayPal accepted" width="45" height="30" loading="lazy" decoding="async"></li>
                                <li><img src="{{asset('client/img/payment/4.jpg' )}}" alt="American Express accepted" width="45" height="30" loading="lazy" decoding="async"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END FOOTER AREA -->

    <!-- Placed and deferred so parsing is never blocked -->

    <script defer src="{{ asset('client/js/vendor/jquery-3.6.0.min.js' )}}"></script>
    <script defer src="{{ asset('client/js/bootstrap.bundle.min.js' )}}"></script>
    <!-- All js plugins included in this file. -->
    <script defer src="{{ asset('client/js/plugins.js' )}}"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script defer src="{{ asset('client/js/main.js' )}}"></script>
    <script defer src="{{ asset('client/js/ecom-shop.js' )}}"></script>

</body>

</html>