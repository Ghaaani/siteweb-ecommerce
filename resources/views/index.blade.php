@extends('client.layouts.app')

@section('title', 'Home')
@section('meta', 'Hand-picked pieces at honest prices — free delivery on every order, paid by card or PayPal.')

@section('content')

<!-- START HERO (static, single authored moment) -->
<section class="ecom-hero section" aria-label="Welcome to the shop">
    <div class="container">
        <div class="ecom-hero-inner">
            <div class="ecom-hero-copy">
                <p class="ecom-hero-kicker">New season Â· up to 40% off</p>
                <h1 class="ecom-hero-title ecom-rise">Beautiful pieces, honest prices</h1>
                <p class="ecom-hero-sub ecom-rise" style="animation-delay:.12s">Hand-picked for your home or office, with free delivery on every order.
                Checkout takes a couple of clicks with your card or PayPal.</p>
                <div class="ecom-hero-actions ecom-rise" style="animation-delay:.24s">
                    <a href="/shop" class="button extra-small button-black"><span class="text-uppercase">Shop now</span></a>
                    <a href="/shop" class="ecom-hero-link">Browse the collection <i class="zmdi zmdi-long-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="ecom-hero-media ecom-rise" style="animation-delay:.18s">
                <img src="{{ asset('client/img/banner/1.jpg') }}" alt="A featured product from our shop"
                    width="363" height="375" fetchpriority="high" decoding="async">
            </div>
        </div>
    </div>
</section>
<!-- END HERO -->

<!-- START PAGE CONTENT -->

<section id="page-content" class="page-wrapper section">

    <!-- BANNER-SECTION START -->
    <div class="banner-section ptb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-30">
                    <div class="section-title text-start">
                        <h2 class="uppercase">Shop by category</h2>
                        <p class="section-sub">Everything we make, sorted by the room it belongs to.</p>
                    </div>
                </div>
                @foreach ($categories as $categorie)
                <div class="col-lg-4 col-md-6">
                    <div class="banner-item banner-2 ecom-category-card">
                        <div class="banner-img">
                            <a href="/shop?category={{ $categorie->id }}">
                                <img src="{{ asset('client/img/banner/2.jpg') }}" alt="{{ $categorie->name }}" loading="lazy" decoding="async">
                            </a>
                        </div>
                        <h3 class="banner-title-2"><a href="/shop?category={{ $categorie->id }}">{{ $categorie->name }}</a></h3>
                        <div class="banner-button">
                            <a href="/shop?category={{ $categorie->id }}">Shop now <i class="zmdi zmdi-long-arrow-right" aria-hidden="true"></i></a>
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
                        <p class="section-sub">The latest pieces that just landed in the store.</p>
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
                <div class="col-lg-12">
                    <div class="section-title text-start mb-40">
                        <h2 class="uppercase">Popular list</h2>
                        <p class="section-sub">Our most loved products right now.</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row flex-wrap">
                        @forelse($productss as $product)
                            <div class="col-lg-4 col-md-6">
                                @include('client.partials.product-card', ['product' => $product])
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="empty-cart box-shadow p-60 text-center">
                                    <h3 class="mb-20">No popular products yet</h3>
                                    <p>Mark a product as popular from the admin area to see it here.</p>
                                </div>
                            </div>
                        @endforelse
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
                                <img src="{{ asset('client/img/up-comming/2.jpg') }}" alt="Featured collection" loading="lazy" decoding="async">
                            </a>
                        </div>
                        <div class="up-comming-pro-info f-left">
                            <h3><a href="/shop">The whole collection, in one place</a></h3>
                            <p>Everything in the store is picked to work together — so you can style your space in a single visit. New pieces land every week.</p>
                            <div class="up-comming-time-2 clearfix">
                                <a href="/shop" class="button extra-small button-black"><span class="text-uppercase">Shop the collection</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-block d-md-none d-lg-block">
                    <div class="banner-item banner-1">
                        <div class="banner-img">
                            <a href="/shop"><img src="{{ asset('client/img/banner/1.jpg') }}" alt="A featured product from our shop" loading="lazy" decoding="async"></a>
                        </div>
                        <div class="banner-info">
                            <h3><a href="/shop">Why shop with us</a></h3>
                            <ul class="banner-featured-list">
                                <li><i class="zmdi zmdi-check" aria-hidden="true"></i><span>Free delivery over $99</span></li>
                                <li><i class="zmdi zmdi-check" aria-hidden="true"></i><span>30 day returns, no questions</span></li>
                                <li><i class="zmdi zmdi-check" aria-hidden="true"></i><span>PayPal, credit or debit card</span></li>
                                <li><i class="zmdi zmdi-check" aria-hidden="true"></i><span>Real people, real support</span></li>
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
                            <h2 class="newsletter-title">Join the newsletter</h2>
                            <p>One short email when new pieces land — never spam. <br class="hidden-xs">Unsubscribe any time.</p>
                        </div>
                        <div class="subcribe clearfix">
                            <form action="{{ route('subscriber.store') }}" method="POST" id="newsletter-form">
                                @csrf
                                <label class="visually-hidden" for="newsletter-email">Email address</label>
                                <input type="email" name="email" id="newsletter-email" required spellcheck="false"
                                    autocomplete="email" placeholder="you@example.com"/>
                                <button class="submit-btn-2 btn-hover-2" type="submit">Subscribe</button>
                            </form>
                        </div>
                        <p id="newsletter-message" class="mt-10 text-center" role="status" aria-live="polite"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- NEWSLETTER SECTION END -->
</section>
<!-- END PAGE CONTENT -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#newsletter-form').on('submit', function (e) {
            e.preventDefault();
            var email = $('#newsletter-email').val();
            var message = $('#newsletter-message');
            if (!email || email.indexOf('@') === -1) {
                message.text('Please enter a valid email address, for example you@example.com.').css('color', 'var(--ecom-danger)');
                return;
            }
            var button = $('#newsletter-form button').prop('disabled', true);
            $.ajax({
                url: $('#newsletter-form').attr('action'),
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { email: email },
                success: function (response) {
                    message.text(response.message || 'Thanks! You are on the list.').css('color', 'var(--ecom-success)');
                    $('#newsletter-email').val('');
                },
                error: function (xhr) {
                    var msg = 'Could not save your email right now — please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) { msg = xhr.responseJSON.message; }
                    message.text(msg).css('color', 'var(--ecom-danger)');
                },
                complete: function () { button.prop('disabled', false); }
            });
        });
    });
</script>

@endsection
