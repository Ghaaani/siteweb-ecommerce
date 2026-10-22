@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Order #{{ $order->id }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Customer</h5>
                        <ul class="list-unstyled">
                            <li><strong>Name:</strong> {{ $order->name }}</li>
                            <li><strong>Email:</strong> {{ $order->email }}</li>
                            <li><strong>Phone:</strong> {{ $order->phone ?? 'n/a' }}</li>
                            <li><strong>Address:</strong> {{ $order->address ?? 'n/a' }}</li>
                            <li><strong>City:</strong> {{ $order->city ?? 'n/a' }}</li>
                            <li><strong>Country:</strong> {{ $order->country ?? 'n/a' }}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5>Payment</h5>
                        <ul class="list-unstyled">
                            <li><strong>Method:</strong> {{ strtoupper($order->payment_method ?? 'n/a') }}</li>
                            <li><strong>Payment status:</strong> {{ strtoupper($order->payment_status) }}</li>
                            <li><strong>Placed at:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</li>
                        </ul>

                        <form method="POST" action="{{ route('orders.update', $order->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="status">Fulfilment status</label>
                                <select id="status" name="status" class="form-control">
                                    @foreach (['pending', 'paid', 'shipped', 'completed', 'cancelled'] as $status)
                                        <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>

                <h5 class="mt-4">Items</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Line total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ number_format($item->prix, 2) }}</td>
                                    <td>${{ number_format($item->prix * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="3" class="text-right">Subtotal</th>
                                <th>${{ number_format($order->subtotal, 2) }}</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-right">Shipping</th>
                                <th>${{ number_format($order->shipping, 2) }}</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-right">Total</th>
                                <th>${{ number_format($order->total, 2) }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
