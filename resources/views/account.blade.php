@extends('client.layouts.app')

@section('content')

        <!-- Start page content -->
        <section id="page-content" class="page-wrapper section">
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-center mb-40">
                                <h2 class="uppercase">My account</h2>
                                <h6>Your profile and every order you have placed.</h6>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <div class="row">
                                <div class="col-md-4 mb-40">
                                    <div class="box-shadow p-30">
                                        <h6 class="widget-title border-left mb-20">Profile</h6>
                                        <ul class="bill-address">
                                            <li><span>Name:</span> {{ $user->name }}</li>
                                            <li><span>Email:</span> {{ $user->email }}</li>
                                            <li><span>Member since:</span> {{ $user->created_at->format('d/m/Y') }}</li>
                                            <li><span>Role:</span> {{ $user->isAdmin() ? 'Administrator' : 'Customer' }}</li>
                                        </ul>

                                        @if ($user->isAdmin())
                                            <a href="{{ url('/products') }}" class="button mt-20">Open admin area</a>
                                        @endif

                                        <form action="{{ route('logout') }}" method="POST" class="mt-20">
                                            @csrf
                                            <button type="submit" class="button black-bg w-100">Log out</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="box-shadow p-30">
                                        <h6 class="widget-title border-left mb-20">Order history</h6>

                                        @if ($orders->isEmpty())
                                            <div class="empty-cart p-40 text-center">
                                                <h4 class="mb-20">No orders yet</h4>
                                                <p>When you place an order it will show up here.</p>
                                                <a href="{{ url('/shop') }}" class="button mt-20">Start shopping</a>
                                            </div>
                                        @else
                                            <div class="table-responsive">
                                                <table class="text-center" style="width: 100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Items</th>
                                                            <th>Payment</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orders as $order)
                                                            <tr>
                                                                <td>#{{ $order->id }}</td>
                                                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                                                <td>{{ $order->orderItems->sum('quantity') }}</td>
                                                                <td>{{ strtoupper($order->payment_method ?? 'n/a') }}</td>
                                                                <td>
                                                                    <span class="ecom-status ecom-status--{{ $order->status }}">
                                                                        {{ strtoupper($order->status) }}
                                                                    </span>
                                                                </td>
                                                                <td>${{ number_format($order->total, 2) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
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
