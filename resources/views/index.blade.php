@extends('client.layouts.app')

@section('content')

<!-- START SLIDER AREA -->
<div class="slider-area slider-2 section">
    <div class="bend niceties preview-2">

        <div id="nivoslider-2" class="slides">
            <img src="{{ asset('client/img/slider/slider-2/slider-1.jpg')}}" alt="Modern furniture" title="#slider-direction-1"  />
            <img src="{{ asset('client/img/slider/slider-2/slider-1.jpg')}}" alt="Modern furniture" title="#slider-direction-2"  />
            <img src="{{ asset('client/img/slider/slider-2/slider-1.jpg')}}" alt="Modern furniture" title="#slider-direction-3"  />
        </div>

        <!-- ===== direction 1 ===== -->
        <div id="slider-direction-1" class="slider-direction">
            <div class="slider-content-1">
                <div class="title-container">
                    <div class="wow rotateInDownLeft" data-wow-duration="2s" data-wow-delay="0.5s">
                        <h6 class="slider2-title-1">New season · up to 40% off</h6>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                        <h1 class="slider2-title-2">Furniture that feels like home</h1>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">
                        <h2 class="slider2-title-3">Chairs · Lamps · Tables</h2>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s">
                        <p class="slider2-title-4">Hand-picked pieces, honest prices and free delivery on every order. Built for the way you actually live.</p>
                    </div>
                    <div class="slider-button wow fadeInUp" data-wow-duration="1s" data-wow-delay="2.5s">
                        <a href="/shop" class="button extra-small button-black">
                            <span class="text-uppercase">Shop now</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- layer 1 -->
            <div class="slider-content-1-image">
                <div class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="layer-1-1">
                        <img src="{{ asset('client/img/slider/slider-2/layer-1.png') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== direction 2 ===== -->
        <div id="slider-direction-2" class="slider-direction">
            <div class="slider-content-2">
                <div class="title-container">
                    <div class="wow rotateInDownLeft" data-wow-duration="2s" data-wow-delay="0.5s">
                        <h6 class="slider2-title-1">Free delivery over $99</h6>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                        <h1 class="slider2-title-2">Timeless pieces, fair prices</h1>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">
                        <h2 class="slider2-title-3">Made to last</h2>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s">
                        <p class="slider2-title-4">Every item in our store is selected for quality and comfort, so what you buy today still works in years.</p>
                    </div>
                    <div class="slider-button wow fadeInUp" data-wow-duration="1s" data-wow-delay="2.5s">
                        <a href="/shop" class="button extra-small button-black">
                            <span class="text-uppercase">Browse the collection</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- layer 1 -->
            <div class="wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="layer-1-1 layer-2-1">
                    <img src="{{ asset('client/img/slider/slider-2/layer-2.png') }}" alt="" />
                </div>
            </div>
        </div>

        <!-- ===== direction 3 ===== -->
        <div id="slider-direction-3" class="slider-direction">
            <div class="slider-content-1">
                <div class="title-container">
                    <div class="wow rotateInDownLeft" data-wow-duration="2s" data-wow-delay="0.5s">
                        <h6 class="slider2-title-1">Secure checkout · PayPal &amp; cards</h6>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                        <h1 class="slider2-title-2">Order in a couple of clicks</h1>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">
                        <h2 class="slider2-title-3">Cart · Checkout · Done</h2>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s">
                        <p class="slider2-title-4">Add to cart, check out with your favourite payment method and track your order from your account.</p>
                    </div>
                    <div class="slider-button wow fadeInUp" data-wow-duration="1s" data-wow-delay="2.5s">
                        <a href="/shop" class="button extra-small button-black">
                            <span class="text-uppercase">Start shopping</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- layer 1 -->
            <div class="slider-content-1-image">
                <div class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="layer-1-1">
                        <img src="{{ asset('client/img/slider/slider-2/layer-1.png') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SLIDER AREA -->

<!-- START PAGE CONTENT -->

<section id="page-content" class="page-wrapper section">

    <!-- BANNER-SECTION START -->
    <div class="banner-section ptb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-30">
                    <div class="section-title text-start">
                        <h2 class="uppercase">Shop by category</h2>
                        <h6>Everything we make, sorted by the room it belongs to.</h6>
                    </div>
                </div>
                @foreach ($categories as $categorie)
                <div class="col-lg-4 col-md-6">
                    <div class="banner-item banner-2 ecom-category-card">
                        <div class="banner-img">
                            <a href="/shop?category={{ $categorie->id }}"><img src="{{ asset('client/img/banner/2.jpg') }}" alt="{{ $categorie->name }}" /></a>
                        </div>
                        <h3 class="banner-title-2"><a href="/shop?category={{ $categorie->id }}">{{ $categorie->name }}</a></h3>
                        <div class="banner-button">
                            <a href="/shop?category={{ $categorie->id }}">Shop now <i class="zmdi zmdi-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- BANNER-SECTION END -->

    <!-- FEATURED PRODUCT SECTION START -->
    <div class="featured-product-section section-bg-tb pt-80 pb-55">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-start mb-20">
                        <h2 class="uppercase">New products</h2>
                        <h6>The latest pieces that just landed in the store.</h6>
                        <div class="featured-product">
                            <div class="active-featured-product slick-arrow-2">
                                @foreach ($products as $product)
                                    <div class="ecom-product-card-wrap">
                                        @include('client.partials.product-card', ['product' => $product])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FEATURED PRODUCT SECTION END -->

    <!-- PRODUCT TAB SECTION START -->
    <div class="product-tab-section section-bg-tb pt-80 pb-55">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title text-start mb-40">
                        <h2 class="uppercase">Popular list</h2>
                        <h6>Our most loved products right now.</h6>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-tab pro-tab-menu pro-tab-menu-2 text-end">
                        <ul class="nav">
                            <li><a class="active" href="#popular-product" data-bs-toggle="tab">Popular Products </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="tab-content">
                        <div id="popular-product" class="tab-pane active show row flex-wrap" role="tabpanel">
                            @forelse($productss as $product)
                                <div class="col-lg-4 col-md-6">
                                    @include('client.partials.product-card', ['product' => $product])
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="empty-cart box-shadow p-60 text-center">
                                        <h4 class="mb-20">No popular products yet</h4>
                                        <p>Mark a product as popular from the admin area to see it here.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT TAB SECTION END -->

    <!-- UP COMMING PRODUCT SECTION START -->
    <div class="up-comming-product-section ptb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="up-comming-pro gray-bg up-comming-pro-2 clearfix">
                        <div class="up-comming-pro-img f-left">
                            <a href="/shop">
                                <img src="{{ asset('client/img/up-comming/2.jpg') }}" alt="Featured collection">
                            </a>
                        </div>
                        <div class="up-comming-pro-info f-left">
                            <h3><a href="/shop">The whole collection, in one place</a></h3>
                            <p>Chairs, lamps and tables designed to work together — so you can style a whole room in a single visit. New pieces land every week.</p>
                            <div class="up-comming-time-2 clearfix">
                                <a href="/shop" class="button extra-small button-black"><span class="text-uppercase">Shop the collection</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-block d-md-none d-lg-block">
                    <div class="banner-item banner-1">
                        <div class="banner-img">
                            <a href="/shop"><img src="{{ asset('client/img/banner/1.jpg') }}" alt="Furniture banner"></a>
                        </div>
                        <div class="banner-info">
                            <h3><a href="/shop">Why shop with us</a></h3>
                            <ul class="banner-featured-list">
                                <li><i class="zmdi zmdi-check"></i><span>Free delivery over $99</span></li>
                                <li><i class="zmdi zmdi-check"></i><span>30 day returns, no questions</span></li>
                                <li><i class="zmdi zmdi-check"></i><span>PayPal, credit or debit card</span></li>
                                <li><i class="zmdi zmdi-check"></i><span>Real people, real support</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- UP COMMING PRODUCT SECTION END -->

    <!-- NEWSLETTER SECTION START -->
    <div class="newsletter-section section-bg-tb pt-60 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="newsletter">
                        <div class="newsletter-info text-center">
                            <h2 class="newsletter-title">get a newsletter</h2>
                            <p>Make sure that you never miss our interesting news <br class="hidden-xs">by joining our newsletter program.</p>
                        </div>
                        <div class="subcribe clearfix">
                            <form action="#" id="newsletter-form">
                                <input type="text" name="email" id="newsletter-email" placeholder="Enter your email here..."/>
                                <button class="submit-btn-2 btn-hover-2" type="submit">subcribe</button>
                            </form>
                            <p id="newsletter-message" class="mt-10"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- NEWSLETTER SECTION END -->
</section>
<!-- END PAGE CONTENT -->

<script>
    $('#newsletter-form').on('submit', function (e) {
        e.preventDefault();
        var email = $('#newsletter-email').val();
        var message = $('#newsletter-message');
        if (!email || email.indexOf('@') === -1) {
            message.text('Please enter a valid email address.').css('color', 'var(--ecom-danger)');
            return;
        }
        message.text('Thanks! You are on the list.').css('color', 'var(--ecom-success)');
        $('#newsletter-email').val('');
    });
</script>

@endsection
