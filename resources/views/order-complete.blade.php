@extends('client.layouts.app')

@section('title', 'Order complete')
@section('meta', 'Thank you for your order — here is your confirmation.')

@section('content')

        <!-- Start page content -->
        <section id="page-content" class="page-wrapper section">
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="order-complete-content box-shadow p-60 text-center">
                                <div class="thank-you p-30 text-center">
                                    <div class="thankyou-icon mb-30">
                                        <i class="zmdi zmdi-check" aria-hidden="true"></i>
                                    </div>
                                    <h1 class="text-black-5 mb-10">Thank you. Your order has been received.</h1>
                                    <p class="mb-0">We have sent your order confirmation to <strong>{{ $checkout->email }}</strong>.</p>
                                </div>

                                <div class="order-info p-30 mb-10">
                                    <ul class="order-info-list">
                                        <li>
                                            <p class="order-info-label">Order no</p>
                                            <p>#{{ $checkout->id }}</p>
                                        </li>
                                        <li>
                                            <p class="order-info-label">Date</p>
                                            <p>{{ $checkout->created_at->format('d/m/Y') }}</p>
                                        </li>
                                        <li>
                                            <p class="order-info-label">Payment</p>
                                            <p>{{ strtoupper($checkout->payment_method) }}</p>
                                        </li>
                                        <li>
                                            <p class="order-info-label">Status</p>
                                            <p>{{ strtoupper($checkout->status) }}</p>
                                        </li>
                                    </ul>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="payment-details p-30">
                                            <h2 class="widget-title border-left mb-20">Your order</h2>
                                            <table>
                                                <tbody>
                                                    @foreach($checkout->orderItems as $item)
                                                    <tr>
                                                        <td class="td-title-1">{{ $item->name }} × {{ $item->quantity }}</td>
                                                        <td class="td-title-2">${{ number_format($item->prix * $item->quantity, 2) }}</td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td class="td-title-1">Cart subtotal</td>
                                                        <td class="td-title-2">${{ number_format($checkout->subtotal, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="td-title-1">Shipping and handling</td>
                                                        <td class="td-title-2">{{ $checkout->shipping > 0 ? '$' . number_format($checkout->shipping, 2) : 'Free' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="td-title-1">Order total</td>
                                                        <td class="td-title-2 order-total-price">${{ number_format($checkout->total, 2) }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="bill-details p-30">
                                            <h2 class="widget-title border-left mb-20">Billing details</h2>
                                            <ul class="bill-address">
                                                <li><span>Address:</span> {{ $checkout->address ?? 'N/A' }}</li>
                                                <li><span>City:</span> {{ $checkout->city ?? 'N/A' }}</li>
                                                <li><span>Country:</span> {{ $checkout->country ?? 'N/A' }}</li>
                                                <li><span>Email:</span> {{ $checkout->email }}</li>
                                                <li><span>Phone:</span> {{ $checkout->phone ?? 'N/A' }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-30">
                                    <div class="col-md-12 text-center">
                                        <a href="/shop" class="button">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End page content -->

@endsection
