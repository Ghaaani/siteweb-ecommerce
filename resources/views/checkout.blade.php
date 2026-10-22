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
                                    <a href="/cart"><span>01</span> Shopping cart</a>
                                </li>
                                <li>
                                    <a class="active" href="#checkout"><span>02</span> Checkout</a>
                                </li>
                                <li>
                                    <a href="#order-complete"><span>03</span> Order complete</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-10">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- checkout start -->
                                <div class="tab-pane active" id="checkout">
                                    <div class="checkout-content box-shadow p-30">
                                        <div class="row">
                                            <!-- billing details -->
                                            <div class="col-md-6">
                                                <div class="billing-details pr-10">
                                                    <h6 class="widget-title border-left mb-20">Billing details</h6>
                                                    <input type="text" id="billing-name" placeholder="Your Name Here..." value="{{ auth()->user()?->name }}">
                                                    <input type="email" id="billing-email" placeholder="Email address here..." value="{{ auth()->user()?->email }}">
                                                    <input type="tel" id="billing-phone" placeholder="Phone here...">
                                                    <input type="text" id="billing-company" placeholder="Company name here...">
                                                    <select class="custom-select" id="billing-country">
                                                        <option value="">Country</option>
                                                        <option value="Morocco">Morocco</option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Bangladesh">Bangladesh</option>
                                                        <option value="United States">United States</option>
                                                        <option value="United Kingdom">United Kingdom</option>
                                                    </select>
                                                    <input type="text" id="billing-city" placeholder="Town / City">
                                                    <textarea class="custom-textarea" id="billing-address" placeholder="Your address here..."></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- our order -->
                                                <div class="payment-details pl-10 mb-50">
                                                    <h6 class="widget-title border-left mb-20">Your order</h6>
                                                    <table>
                                                        <tbody>
                                                            @forelse($cart['items'] as $item)
                                                                <tr>
                                                                    <td class="td-title-1">{{ $item->name }} x {{ $item->quantity }}</td>
                                                                    <td class="td-title-2">${{ number_format($item->prix * $item->quantity, 2) }}</td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td class="td-title-1">Your cart is empty</td>
                                                                    <td class="td-title-2">$0.00</td>
                                                                </tr>
                                                            @endforelse
                                                            <tr>
                                                                <td class="td-title-1">Cart Subtotal</td>
                                                                <td class="td-title-2">${{ number_format($cart['subtotal'], 2) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="td-title-1">Shipping and Handling</td>
                                                                <td class="td-title-2">${{ number_format($cart['shipping'], 2) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="td-title-1">Vat</td>
                                                                <td class="td-title-2">$0.00</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="order-total">Order Total</td>
                                                                <td class="order-total-price">${{ number_format($cart['total'], 2) }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!-- payment-method -->
                                                <div class="payment-method">
                                                    <h6 class="widget-title border-left mb-20">Payment method</h6>
                                                    <div id="accordion">
                                                        <div class="panel">
                                                            <h4 class="payment-title box-shadow">
                                                                <a data-bs-toggle="collapse" href="#card-payment">
                                                                    <i class="zmdi zmdi-credit-card"></i> Credit / Debit card
                                                                </a>
                                                            </h4>
                                                            <div id="card-payment" class="panel-collapse collapse show" data-bs-parent="#accordion">
                                                                <div class="payment-content">
                                                                    <p>Pay securely with your credit or debit card. All transactions are encrypted.</p>

                                                                    @if(config('services.stripe.publishable'))
                                                                        <div id="payment-element" class="mb-20"></div>
                                                                    @else
                                                                        <div id="demo-card-fields" class="mb-20">
                                                                            <input type="text" id="card-number" placeholder="Card number (4242 4242 4242 4242)" autocomplete="cc-number">
                                                                            <div class="row mt-2">
                                                                                <div class="col-sm-6 col-xs-12">
                                                                                    <input type="text" id="card-expiry" placeholder="MM / YY" autocomplete="cc-exp">
                                                                                </div>
                                                                                <div class="col-sm-6 col-xs-12">
                                                                                    <input type="text" id="card-cvc" placeholder="CVC" autocomplete="cc-csc">
                                                                                </div>
                                                                            </div>
                                                                            <input type="text" id="card-name" placeholder="Name on card" autocomplete="cc-name">
                                                                            <p class="mt-10"><small>Test mode: use 4242 4242 4242 4242 with any future expiry date.</small></p>
                                                                        </div>
                                                                    @endif

                                                                    <div id="card-errors" class="mt-10"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel">
                                                            <h4 class="payment-title box-shadow">
                                                                <a class="collapsed" data-bs-toggle="collapse" href="#paypal-payment">
                                                                    <i class="zmdi zmdi-paypal"></i> PayPal
                                                                </a>
                                                            </h4>
                                                            <div id="paypal-payment" class="panel-collapse collapse" data-bs-parent="#accordion">
                                                                <div class="payment-content">
                                                                    <p>Pay via PayPal; you can pay with your credit card if you don't have a PayPal account.</p>
                                                                    <ul class="payent-type mt-10">
                                                                        <li><img src="{{ asset('client/img/payment/1.png') }}" alt="Visa"></li>
                                                                        <li><img src="{{ asset('client/img/payment/2.png') }}" alt="Mastercard"></li>
                                                                        <li><img src="{{ asset('client/img/payment/3.png') }}" alt="PayPal"></li>
                                                                        <li><img src="{{ asset('client/img/payment/4.png') }}" alt="American Express"></li>
                                                                    </ul>
                                                                    <div id="paypal-container" class="mt-20"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- payment-method end -->

                                                <div id="checkout-message" class="mt-20"></div>

                                                <button class="submit-btn-1 black-bg btn-hover-2 mt-30" id="place-order" type="button">
                                                    <span class="btn-label">Place order</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- checkout end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SHOP SECTION END -->

        </section>
        <!-- End page content -->

@if(config('services.stripe.publishable'))
    <script src="https://js.stripe.com/v3/"></script>
@endif

<script>
    var stripe = null;
    var elements = null;
    var cardElements = null;
    var checkoutId = @json($checkout->id ?? null);
    var stripeKey = @json(config('services.stripe.publishable'));
    var paypalClientId = @json(config('services.paypal.client_id'));

    function setMessage(text, type) {
        var box = $('#checkout-message');
        box.text(text);
        box.css('color', type === 'error' ? 'var(--ecom-danger)' : 'var(--ecom-success)');
    }

    function setLoading(loading) {
        var btn = $('#place-order');
        btn.prop('disabled', loading);
        $('.btn-label', btn).text(loading ? 'Processing…' : 'Place order');
    }

    function validateBilling() {
        var errors = [];
        if (!$('#billing-name').val()) { errors.push('Your name is required.'); }
        var email = $('#billing-email').val();
        if (!email || email.indexOf('@') === -1) { errors.push('A valid email address is required.'); }
        if (!$('#billing-address').val()) { errors.push('A shipping address is required.'); }
        if (!$('#billing-city').val()) { errors.push('A city is required.'); }
        if (!$('#billing-country').val()) { errors.push('Please select your country.'); }
        return errors;
    }

    function selectedMethod() {
        var collapsed = document.querySelector('#card-payment');
        var cardVisible = collapsed && collapsed.classList.contains('show');
        return cardVisible ? 'card' : 'paypal';
    }

    $(document).ready(function() {
        // Keep the payment method in sync with the visible accordion panel.
        $('#card-payment, #paypal-payment').on('shown.bs.collapse', function() {
            var card = $('#card-payment').hasClass('show');
            $('#place-order').find('.btn-label').text(card ? 'Place order' : 'Place order with PayPal');
        });

        $('#place-order').on('click', function() {
            var errors = validateBilling();
            if (errors.length) {
                setMessage(errors.join(' '), 'error');
                return;
            }

            var method = selectedMethod();
            setLoading(true);
            setMessage('', 'success');

            $.ajax({
                url: '/checkout',
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    name: $('#billing-name').val(),
                    email: $('#billing-email').val(),
                    phone: $('#billing-phone').val(),
                    address: $('#billing-address').val(),
                    city: $('#billing-city').val(),
                    country: $('#billing-country').val(),
                    payment_method: method
                },
                success: function(response) {
                    if (!response.success) {
                        setLoading(false);
                        setMessage(response.message || 'Something went wrong.', 'error');
                        return;
                    }

                    checkoutId = response.checkout_id;

                    if (method === 'paypal') {
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        } else {
                            setLoading(false);
                            setMessage('Could not start the PayPal payment. Please try again.', 'error');
                        }
                        return;
                    }

                    // Card payment
                    if (response.payment_intent_client_secret && stripe) {
                        confirmCardPayment(response.payment_intent_client_secret);
                    } else {
                        simulateCardPayment();
                    }
                },
                error: function(xhr) {
                    setLoading(false);
                    var message = 'Something went wrong while placing your order.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var first = xhr.responseJSON.errors;
                        message = Object.values(first)[0][0];
                    }
                    setMessage(message, 'error');
                }
            });
        });

        function confirmCardPayment(clientSecret) {
            if (!stripe) {
                simulateCardPayment();
                return;
            }

            if (!elements) {
                elements = stripe.elements({ clientSecret: clientSecret });
                cardElements = elements.create('payment', { layout: 'tabs' });
                var mount = document.getElementById('payment-element');
                if (mount) { cardElements.mount(mount); }
            }

            elements.submit().then(function(result) {
                if (result.error) {
                    setLoading(false);
                    setMessage(result.error.message, 'error');
                    return;
                }

                stripe.confirmPayment({
                    elements: elements,
                    confirmParams: {
                        return_url: window.location.origin + '/checkout/success/' + checkoutId
                    }
                }).then(function(result) {
                    if (result.error) {
                        setLoading(false);
                        $('#card-errors').text(result.error.message);
                        setMessage(result.error.message, 'error');
                        return;
                    }
                    markPaidAndRedirect(checkoutId);
                });
            });
        }

        function simulateCardPayment() {
            var number = $('#card-number').val();
            var expiry = $('#card-expiry').val();
            var cvc = $('#card-cvc').val();

            if (!number || number.replace(/\s/g, '').length < 12 || !expiry || !cvc) {
                setLoading(false);
                setMessage('Please complete the card details.', 'error');
                return;
            }

            setTimeout(function() {
                markPaidAndRedirect(checkoutId);
            }, 900);
        }

        function markPaidAndRedirect(id) {
            $.ajax({
                url: '/checkout/' + id + '/paid',
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {},
                success: function() {
                    window.location.href = '/checkout/success/' + id;
                },
                error: function() {
                    window.location.href = '/checkout/success/' + id;
                }
            });
        }

        // Mount the Stripe Payment Element when Stripe is configured.
        if (stripeKey) {
            stripe = Stripe(stripeKey);
        }
    });
</script>

@endsection
