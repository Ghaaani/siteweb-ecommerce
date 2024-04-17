@extends('client.layouts.app')

@section('content')

<style>
    #popular-product {
    display: flex;
    flex-wrap: wrap;
}
</style>
<!-- START SLIDER AREA -->
<div class="slider-area slider-2 section">
    <div class="bend niceties preview-2">
        
        <div id="nivoslider-2" class="slides">   
            <img src="{{ asset('client/img/slider/slider-2/slider-1.jpg')}}" alt="" title="#slider-direction-1"  />
            <img src="{{ asset('client/img/slider/slider-2/slider-1.jpg')}}" alt="" title="#slider-direction-2"  />
            <img src="{{ asset('client/img/slider/slider-2/slider-1.jpg')}}" alt="" title="#slider-direction-3"  />
            <img src="{{ asset('client/img/slider/slider-2/slider-1.jpg')}}" alt="" title="#slider-direction-4"  />
            <img src="{{ asset('client/img/slider/slider-2/slider-1.jpg')}}" alt="" title="#slider-direction-5"  />
        </div>

        <!-- ===== direction 1 ===== -->
        <div id="slider-direction-1" class="slider-direction">
            <div class="slider-content-1">
                <div class="title-container">
                    <div class="wow rotateInDownLeft" data-wow-duration="2s" data-wow-delay="0.5s">
                        <h6 class="slider2-title-1">Best price : 866 DHs</h6>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                        <h1 class="slider2-title-2">new smart phone</h1>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">
                        <h2 class="slider2-title-3">Samsung grand 6</h2>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s">
                        <p class="slider2-title-4">There are many variations of passages of Lorem Ipsum availables, but the majority have suffered alteration in some form.</p>
                    </div>
                    <div class="slider-button wow fadeInUp" data-wow-duration="1s" data-wow-delay="2.5s">
                        <a href="#" class="button extra-small button-black">
                            <span class="text-uppercase">Buy now</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- layer 1 -->
            <div class="slider-content-1-image">
                <div class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="layer-1-1">
                        <img src="{{ asset('client/img/slider/slider-2/layer-1.png' )}}" alt="" />
                    </div>
                </div>
            </div>
        </div>
        <!-- ===== direction 2 ===== -->
        <div id="slider-direction-2" class="slider-direction">
            <div class="slider-content-2">
                <div class="title-container">
                    <div class="wow rotateInDownLeft" data-wow-duration="2s" data-wow-delay="0.5s">
                        <h6 class="slider2-title-1">Best price : 866 DHs</h6>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                        <h1 class="slider2-title-2">new smart phone</h1>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">
                        <h2 class="slider2-title-3">Samsung grand 6</h2>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s">
                        <p class="slider2-title-4">There are many variations of passages of Lorem Ipsum availables, but the majority have suffered alteration in some form.</p>
                    </div>
                    <div class="slider-button wow fadeInUp" data-wow-duration="1s" data-wow-delay="2.5s">
                        <a href="#" class="button extra-small button-black">
                            <span class="text-uppercase">Buy now</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- layer 1 -->
            <div class="wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="layer-1-1 layer-2-1">
                    <img src="{{ asset('client/img/slider/slider-2/layer-2.png' )}}" alt="" />
                </div>
            </div>
        </div>
        <!-- ===== direction 3 ===== -->
        <div id="slider-direction-3" class="slider-direction">
            <div class="slider-content-1">
                <div class="title-container">
                    <div class="wow rotateInDownLeft" data-wow-duration="2s" data-wow-delay="0.5s">
                        <h6 class="slider2-title-1">Best price : 866 DHs</h6>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                        <h1 class="slider2-title-2">new smart phone</h1>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">
                        <h2 class="slider2-title-3">Samsung grand 6</h2>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s">
                        <p class="slider2-title-4">There are many variations of passages of Lorem Ipsum availables, but the majority have suffered alteration in some form.</p>
                    </div>
                    <div class="slider-button wow fadeInUp" data-wow-duration="1s" data-wow-delay="2.5s">
                        <a href="#" class="button extra-small button-black">
                            <span class="text-uppercase">Buy now</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- layer 1 -->
            <div class="slider-content-1-image">
                <div class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="layer-1-1">
                        <img src="{{ asset('client/img/slider/slider-2/layer-1.png' )}}" alt="" />
                    </div>
                </div>
            </div>
        </div>
        <!-- ===== direction 4 ===== -->
        <div id="slider-direction-4" class="slider-direction">
            <div class="slider-content-2">
                <div class="title-container">
                    <div class="wow rotateInDownLeft" data-wow-duration="2s" data-wow-delay="0.5s">
                        <h6 class="slider2-title-1">Best price : 866 DHs</h6>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                        <h1 class="slider2-title-2">new smart phone</h1>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">
                        <h2 class="slider2-title-3">Samsung grand 6</h2>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s">
                        <p class="slider2-title-4">There are many variations of passages of Lorem Ipsum availables, but the majority have suffered alteration in some form.</p>
                    </div>
                    <div class="slider-button wow fadeInUp" data-wow-duration="1s" data-wow-delay="2.5s">
                        <a href="#" class="button extra-small button-black">
                            <span class="text-uppercase">Buy now</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- layer 1 -->
            <div class="wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="layer-1-1 layer-2-1">
                    <img src="{{ asset('client/img/slider/slider-2/layer-2.png' )}}" alt="" />
                </div>
            </div>
        </div>
        <!-- ===== direction 5 ===== -->
        <div id="slider-direction-5" class="slider-direction">
            <div class="slider-content-1">
                <div class="title-container">
                    <div class="wow rotateInDownLeft" data-wow-duration="2s" data-wow-delay="0.5s">
                        <h6 class="slider2-title-1">Best price : 866 DHs</h6>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                        <h1 class="slider2-title-2">new smart phone</h1>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">
                        <h2 class="slider2-title-3">Samsung grand 6</h2>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s">
                        <p class="slider2-title-4">There are many variations of passages of Lorem Ipsum availables, but the majority have suffered alteration in some form.</p>
                    </div>
                    <div class="slider-button wow fadeInUp" data-wow-duration="1s" data-wow-delay="2.5s">
                        <a href="#" class="button extra-small button-black">
                            <span class="text-uppercase">Buy now</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- layer 1 -->
            <div class="slider-content-1-image">
                <div class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="layer-1-1">
                        <img src="{{ asset('client/img/slider/slider-2/layer-1.png' )}}" alt="" />
                    </div>
                </div>
            </div>
        </div>
        <!-- ==== -->
    </div>
</div>
<!-- END SLIDER AREA -->

<!-- START PAGE CONTENT -->

<section id="page-content" class="page-wrapper section">

    <!-- BANNER-SECTION START -->
    <div class="banner-section ptb-60">
        <div class="container">
            <div class="row">
            <h2 class="uppercase bold">Categories</h2>
                <!-- banner-item start -->
                @foreach ($categories as $categorie)
                <div class="col-lg-4 col-md-6">
                    <div class="banner-item banner-2">
                        <div class="banner-img">
                            <a href="#"><img src="{{ asset('client/img/banner/2.jpg' )}}" alt="" /></a>
                        </div>
                        <h3 class="banner-title-2"><a href="#">{{$categorie->name}}</a></h3>
                        <h3 class="pro-price"></h3>
                        <div class="banner-button">
                            <a href="#">Shop now <i class="zmdi zmdi-long-arrow-right"></i></a> 
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- banner-item end -->

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
                        <h2 class="uppercase">new products</h2>
                        <h6>There are many variations of passages of brands available,</h6>
                        <div class="featured-product">
                            <div class="active-featured-product slick-arrow-2">

                            @foreach ($products as $product)
                                <div class="product-item product-item-2">
                                    <div class="product-img">
                                        <a href="/single_product"> 
                                            <img src="{{ asset('storage/images/product/'.$product->image)}}" alt=""/>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-title">
                                            <a href="/single_product">{{$product->name}}</a>
                                        </h6>
                                        <h6 class="brand-name">Sumsung</h6>
                                        <h3 class="pro-price">{{$product->price}} DHs</h3>
                                    </div>
                                    <ul class="action-button">
                                        <li>
                                            <a href="#" title="Wishlist"><i class="zmdi zmdi-favorite"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" data-bs-toggle="modal"  data-bs-target="#productModal" title="Quickview"><i class="zmdi zmdi-zoom-in"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" title="Add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
                                        </li>
                                    </ul>
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

    <!-- UP COMMING PRODUCT SECTION START -->
    <div class="up-comming-product-section ptb-60">
        <div class="container">
            <div class="row">
                <!-- up-comming-pro -->
                <div class="col-lg-8">
                    <div class="up-comming-pro gray-bg up-comming-pro-2 clearfix">
                        <div class="up-comming-pro-img f-left">
                            <a href="#">
                                <img src="{{ asset('client/img/up-comming/2.jpg') }}" alt="Up Comming Product Image">
                            </a>
                        </div>
                        <div class="up-comming-pro-info f-left">
                            <h3><a href="#">Dummy Product Name</a></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elitest, sed do eiusmod tempor incididunt ut labore et dolores top magna aliqua. Ut enim ad minim veniam, quis nostrud exer citation ullamco laboris nisi ut aliquip ex ea commodo consequat. laborum. </p>
                            <div class="up-comming-time-2 clearfix">
                                <div data-countdown="2019/01/15"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-block d-md-none d-lg-block">
                    <div class="banner-item banner-1">
                        <div class="ribbon-price">
                            <span>896.00 DHs</span>
                        </div>
                        <div class="banner-img">
                            <a href="#"><img src="{{ asset('client/img/banner/1.jpg' )}}" alt=""></a>
                        </div>
                        <div class="banner-info">
                            <h3><a href="#">Product Name</a></h3>
                            <ul class="banner-featured-list">
                                <li>
                                    <i class="zmdi zmdi-check"></i><span>Lorem ipsum dolor</span>
                                </li>
                                <li>
                                    <i class="zmdi zmdi-check"></i><span>amet, consectetur</span>
                                </li>
                                <li>
                                    <i class="zmdi zmdi-check"></i><span>adipisicing elitest,</span>
                                </li>
                                <li>
                                    <i class="zmdi zmdi-check"></i><span>eiusmod tempor</span>
                                </li>
                                <li>
                                    <i class="zmdi zmdi-check"></i><span>labore et dolore.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- UP COMMING PRODUCT SECTION END -->

    <!-- PRODUCT TAB SECTION START -->
    <div class="product-tab-section section-bg-tb pt-80 pb-55">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title text-start mb-40">
                        <h2 class="uppercase">Popular list</h2>
                        <h6>There are many variations of passages of brands available,</h6>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-tab pro-tab-menu pro-tab-menu-2 text-end">
                        <!-- Nav tabs -->
                        <ul class="nav" >
                            <li><a class="active" href="#popular-product" data-bs-toggle="tab">Popular Products </a></li>
                        </ul>
                    </div>                       
                </div>
                <div class="col-lg-12">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- popular-product start -->
                        <div id="popular-product" class="tab-pane active show row flex-wrap" role="tabpanel">



                         </div>
                         
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- PRODUCT TAB SECTION END -->

    <!-- BLOG SECTION START -->
    <div class="blog-section-2 pt-60 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-start mb-40">
                        <h2 class="uppercase">Latest blog</h2>
                        <h6>There are many variations of passages of brands available,</h6>
                    </div>
                </div>
            </div>
            <div class="blog">
                <div class="row active-blog-2">
                    <!-- blog-item start -->
                    <div class="col-lg-12">
                        <div class="blog-item-2">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="blog-image">
                                        <a href="/single_blog"><img src="{{ asset('client/img/blog/4.jpg' )}}" alt="" /></a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="blog-desc">
                                        <h5 class="blog-title-2"><a href="#">dummy Blog name</a></h5>
                                        <p>There are many variations of passages of in psum available, but the majority have sufe ered on in some form...</p>
                                        <div class="read-more">
                                            <a href="#">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- blog-item end -->
                    <!-- blog-item start -->
                    <div class="col-lg-12">
                        <div class="blog-item-2">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="blog-image">
                                        <a href="/single_blog"><img src="{{ asset('client/img/blog/5.jpg' )}}" alt="" /></a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="blog-desc">
                                        <h5 class="blog-title-2"><a href="#">dummy Blog name</a></h5>
                                        <p>There are many variations of passages of in psum available, but the majority have sufe ered on in some form...</p>
                                        <div class="read-more">
                                            <a href="#">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- blog-item end -->
                    <!-- blog-item start -->
                    <div class="col-lg-12">
                        <div class="blog-item-2">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="blog-image">
                                        <a href="/single_blog"><img src="{{ asset('client/img/blog/4.jpg' )}}" alt="" /></a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="blog-desc">
                                        <h5 class="blog-title-2"><a href="#">dummy Blog name</a></h5>
                                        <p>There are many variations of passages of in psum available, but the majority have sufe ered on in some form...</p>
                                        <div class="read-more">
                                            <a href="#">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- blog-item end -->
                </div>
            </div>
        </div>
    </div>
    <!-- BLOG SECTION END -->   
        
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
                            <form action="#">
                                <input type="text" name="email" placeholder="Enter your email here..."/>
                                <button class="submit-btn-2 btn-hover-2" type="submit">subcribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- NEWSLETTER SECTION END -->            
</section>
<!-- END PAGE CONTENT -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
$(document).ready(function() {
    // Fetch products using AJAX
    $.ajax({
        url: '/index',  // Update this to the URL associated with your index method
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
        var productContainer = $('#popular-product');

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
                                            '<h3 class="pro-price">' + product.price + 'DHs </h3>' +
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
                                                    '<a href="#" title="Add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>' +
                                                '</li>' +
                                            '</ul>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>');

            // Append the product item to the container
            productContainer.append(productItem);
        });
    }

    
});

</script>


@endsection