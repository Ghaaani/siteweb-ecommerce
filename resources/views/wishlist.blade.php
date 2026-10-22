@extends('client.layouts.app')

@section('title', 'Wish list')
@section('meta', 'Products you saved for later.')

@section('content')

        <!-- Start page content -->
        <section id="page-content" class="page-wrapper section">
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-center mb-40">
                                <h1 class="uppercase">Wish list</h1>
                                <p class="section-sub">Products you saved for later.</p>
                            </div>

                            @if ($products->isNotEmpty())
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-lg-4 col-md-6">
                                            @include('client.partials.product-card', ['product' => $product])
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-cart box-shadow p-60 text-center">
                                    <h3 class="mb-20">Your wish list is empty</h3>
                                    <p class="mb-30">Tap the heart on any product to save it here.</p>
                                    <a href="{{ url('/shop') }}" class="button">Browse the collection</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End page content -->

@endsection
