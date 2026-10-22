@extends('client.layouts.app')

@section('title', 'Checkout')
@section('meta', 'Secure checkout — pay by credit or debit card or with PayPal.')

@section('content')

        <!-- Start page content -->
        <section id="page-content" class="page-wrapper section">

            <!-- SHOP SECTION START -->
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="section-title text-start mb-30">
                        <h1 class="uppercase">Checkout</h1>
                        <p class="section-sub">A couple of quick steps — pay by card or PayPal.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <ol class="nav cart-tab ecom-steps">
                                <li><a href="/cart">01 · Shopping cart</a></li>
                                <li aria-current="step">02 · Checkout</li>
                                <li>03 · Order complete</li>
                            </ol>
                        </div>
                        <div class="col-lg-10">
                            <!-- Checkout start -->
                            <div class="checkout-content box-shadow p-30">
                                <div class="row">
                                    <!-- billing details -->
                                    <div class="col-md-6">
                                        <form id="checkout-form" novalidate>
                                            <h2 class="widget-title border-left mb-20">Billing details</h2>

                                            <div class="ecom-field ecom-field--2">
                                                <label for="billing-name">Full name</label>
                                                <input type="text" id="billing-name" name="name" required autocomplete="name" spellcheck="false" placeholder="Alex Morgan" value="{{ auth()->user()?->name }}">
                                                <p class="ecom-field-error" id="billing-name-error" hidden>Enter the name the order should go to.</p>
                                            </div>

                                            <div class="ecom-field ecom-field--2">
                                                <label for="billing-email">Email address</label>
                                                <input type="email" id="billing-email" name="email" required autocomplete="email" spellcheck="false" inputmode="email" placeholder="you@example.com" value="{{ auth()->user()?->email }}">
                                                <p class="ecom-field-error" id="billing-email-error" hidden>We email your receipt here — check the format, e.g. you@example.com.</p>
                                            </div>

                                            <div class="ecom-field ecom-field--2">
                                                <label for="billing-phone">Phone <span class="ecom-optional">(optional)</span></label>
                                                <input type="tel" id="billing-phone" name="phone" autocomplete="tel" inputmode="tel" spellcheck="false" placeholder="+1 555 010 0199">
                                                <p class="ecom-field-error" id="billing-phone-error" hidden></p>
                                            </div>

                                            <div class="ecom-field ecom-field--2">
                                                <label for="billing-company">Company <span class="ecom-optional">(optional)</span></label>
                                                <input type="text" id="billing-company" name="company" autocomplete="organization" placeholder="Your business name">
                                                <p class="ecom-field-error" id="billing-company-error" hidden></p>
                                            </div>

                                            <div class="ecom-field ecom-field--2">
                                                <label for="billing-country">Country</label>
                                                <select class="custom-select" id="billing-country" name="country" required autocomplete="country-name">
                                                    <option value="" selected>Select your country</option>
                                                    <option value="Morocco">Morocco</option>
                                                    <option value="Australia">Australia</option>
                                                    <option value="Bangladesh">Bangladesh</option>
                                                    <option value="United States">United States</option>
                                                    <option value="United Kingdom">United Kingdom</option>
                                                </select>
                                                <p class="ecom-field-error" id="billing-country-error" hidden>Pick where we should deliver.</p>
                                            </div>

                                            <div class="ecom-field ecom-field--2">
                                                <label for="billing-city">Town / city</label>
                                                <input type="text" id="billing-city" name="city" required autocomplete="address-level2" placeholder="Portland">
                                                <p class="ecom-field-error" id="billing-city-error" hidden>Enter the town or city for delivery.</p>
                                            </div>

                                            <div class="ecom-field">
                                                <label for="billing-address">Street address</label>
                                                <textarea class="custom-textarea" id="billing-address" name="address" required autocomplete="street-address" placeholder="2210 NW Marine Dr, Apt 4"></textarea>
                                                <p class="ecom-field-error" id="billing-address-error" hidden>Include street and apartment so the courier finds you.</p>
                                            </div>
                                        </form>

                                        <!-- payment-method -->
                                        <div class="payment-method">
                                            <h2 class="widget-title border-left mb-20">Payment method</h2>
                                            <div id="accordion">
                                                <div class="panel">
                                                    <h3 class="payment-title box-shadow">
                                                        <a data-bs-toggle="collapse" href="#card-payment" aria-expanded="true" aria-controls="card-payment">
                                                            <i class="zmdi zmdi-credit-card" aria-hidden="true"></i> Credit / Debit card
                                                        </a>
                                                    </h3>
                                                    <div id="card-payment" class="panel-collapse collapse show" data-bs-parent="#accordion">
                                                        <div class="payment-content">
                                                            <p>Pay securely with your credit or debit card. All transactions are encrypted.</p>

                                                            @if(config('services.stripe.publishable'))
                                                                <div id="payment-element" class="mb-20"></div>
                                                            @else
                                                                <div id="demo-card-fields" class="mb-20">
                                                                    <div class="ecom-field">
                                                                        <label for="card-number">Card number</label>
                                                                        <input type="text" id="card-number" autocomplete="cc-number" inputmode="numeric" spellcheck="false" placeholder="4242 4242 4242 4242">
                                                                        <p class="ecom-field-error" id="card-number-error" hidden>Enter the 16-digit number on the card — in test mode use 4242 4242 4242 4242.</p>
                                                                    </div>
                                                                    <div class="row mt-2">
                                                                        <div class="col-sm-6 col-xs-12">
                                                                            <div class="ecom-field">
                                                                                <label for="card-expiry">Expiry date</label>
                                                                                <input type="text" id="card-expiry" autocomplete="cc-exp" inputmode="numeric" spellcheck="false" placeholder="12 / 28">
                                                                                <p class="ecom-field-error" id="card-expiry-error" hidden>Use a future date in MM / YY format.</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 col-xs-12">
                                                                            <div class="ecom-field">
                                                                                <label for="card-cvc">CVC</label>
                                                                                <input type="text" id="card-cvc" autocomplete="cc-csc" inputmode="numeric" spellcheck="false" placeholder="123">
                                                                                <p class="ecom-field-error" id="card-cvc-error" hidden>The 3-digit code on the back of the card.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ecom-field">
                                                                        <label for="card-name">Name on card</label>
                                                                        <input type="text" id="card-name" autocomplete="cc-name" spellcheck="false" placeholder="As printed on the card">
                                                                        <p class="ecom-field-error" id="card-name-error" hidden>Enter the name printed on the card.</p>
                                                                    </div>
                                                                    <p class="mt-10"><small>Test mode: use 4242 4242 4242 4242 with any future expiry date.</small></p>
                                                                </div>
                                                            @endif

                                                            <div id="card-errors" class="mt-10" role="alert" aria-live="assertive"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel">
                                                    <h3 class="payment-title box-shadow">
                                                        <a class="collapsed" data-bs-toggle="collapse" href="#paypal-payment" aria-expanded="false" aria-controls="paypal-payment">
                                                            <i class="zmdi zmdi-paypal" aria-hidden="true"></i> PayPal
                                                        </a>
                                                    </h3>
                                                    <div id="paypal-payment" class="panel-collapse collapse" data-bs-parent="#accordion">
                                                        <div class="payment-content">
                                                            <p>Pay via PayPal; you can pay with your credit card if you don't have a PayPal account.</p>
                                                            <ul class="payent-type mt-10">
                                                                <li><img src="{{ asset('client/img/payment/1.png') }}" alt="Visa accepted" width="45" height="30"></li>
                                                                <li><img src="{{ asset('client/img/payment/2.png') }}" alt="Mastercard accepted" width="45" height="30"></li>
                                                                <li><img src="{{ asset('client/img/payment/3.png') }}" alt="PayPal accepted" width="45" height="30"></li>
                                                                <li><img src="{{ asset('client/img/payment/4.png') }}" alt="American Express accepted" width="45" height="30"></li>
                                                            </ul>
                                                            <div id="paypal-container" class="mt-20"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- payment-method end -->

                                        <div id="checkout-message" class="mt-20" role="status" aria-live="polite"></div>

                                        <button class="submit-btn-1 black-bg btn-hover-2 mt-30" id="place-order" type="button">
                                            <span class="btn-label">Place order</span>
                                        </button>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- our order -->
                                        <div class="payment-details pl-10 mb-50">
                                            <h2 class="widget-title border-left mb-20">Your order</h2>
                                            <table>
                                                <tbody>
                                                    @forelse($cart['items'] as $item)
                                                        <tr>
                                                            <td class="td-title-1">{{ $item->name }} × {{ $item->quantity }}</td>
                                                            <td class="td-title-2">${{ number_format($item->prix * $item->quantity, 2) }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="td-title-1">Your cart is empty</td>
                                                            <td class="td-title-2">$0.00</td>
                                                        </tr>
                                                    @endforelse
                                                    <tr>
                                                        <td class="td-title-1">Cart subtotal</td>
                                                        <td class="td-title-2">${{ number_format($cart['subtotal'], 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="td-title-1">Shipping and handling</td>
                                                        <td class="td-title-2">{{ $cart['shipping'] > 0 ? '$' . number_format($cart['shipping'], 2) : 'Free' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="order-total">Order total</td>
                                                        <td class="order-total-price">${{ number_format($cart['total'], 2) }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- checkout end -->
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
    document.addEventListener('DOMContentLoaded', function () {
        var stripe = null;
        var elements = null;
        var cardElements = null;
        var stripeKey = @json(config('services.stripe.publishable'));
        var checkoutId = @json($checkout->id ?? null);

        var REQUIRED_FIELDS = ['billing-name', 'billing-email', 'billing-address', 'billing-city', 'billing-country'];

        function fieldError(id, show) {
            var input = document.getElementById(id);
            var error = document.getElementById(id + '-error');
            if (input) { input.setAttribute('aria-invalid', show ? 'true' : 'false'); }
            if (error) { error.hidden = !show; }
        }

        function setMessage(text, type) {
            var box = $('#checkout-message');
            box.text(text);
            box.css('color', type === 'error' ? 'var(--ecom-danger)' : 'var(--ecom-success)');
        }

        function setLoading(loading) {
            var btn = $('#place-order');
            btn.prop('disabled', loading);
            $('.btn-label', btn).text(loading ? 'Processing…' : ($('#card-payment').hasClass('show') ? 'Place order' : 'Place order with PayPal'));
        }

        function validateBilling() {
            var firstInvalid = null;
            var values = {};
            REQUIRED_FIELDS.forEach(function (id) {
                var value = ($('#' + id).val() || '').trim();
                values[id] = value;
                var ok = value !== '';
                if (id === 'billing-email') { ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value); }
                fieldError(id, !ok);
                if (!ok && !firstInvalid) { firstInvalid = document.getElementById(id); }
            });

            if (firstInvalid) {
                firstInvalid.focus({ preventScroll: false });
                return null;
            }
            return values;
        }

        function selectedMethod() {
            var card = document.querySelector('#card-payment');
            return card && card.classList.contains('show') ? 'card' : 'paypal';
        }

        // Keep the payment method in sync with the visible accordion panel.
        $('#card-payment, #paypal-payment').on('shown.bs.collapse', function () {
            setLoading(false);
        });

        $('#place-order').on('click', function () {
            var values = validateBilling();
            if (!values) {
                setMessage('Fix the highlighted fields to place your order.', 'error');
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
                    name: values['billing-name'],
                    email: values['billing-email'],
                    phone: $('#billing-phone').val(),
                    address: values['billing-address'],
                    city: values['billing-city'],
                    country: values['billing-country'],
                    payment_method: method
                },
                success: function (response) {
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
                error: function (xhr) {
                    setLoading(false);
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        var fieldMap = { name: 'billing-name', email: 'billing-email', address: 'billing-address', city: 'billing-city', country: 'billing-country' };
                        var first = null;
                        Object.keys(fieldMap).forEach(function (key) {
                            if (errors[key]) {
                                fieldError(fieldMap[key], true);
                                $('#' + fieldMap[key] + '-error').text(errors[key][0]);
                                first = first || document.getElementById(fieldMap[key]);
                            }
                        });
                        if (first) { first.focus(); }
                        setMessage('Fix the highlighted fields to place your order.', 'error');
                        return;
                    }
                    setMessage('Something went wrong while placing your order — please try again.', 'error');
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

            elements.submit().then(function (result) {
                if (result.error) {
                    setLoading(false);
                    setMessage(result.error.message + ' — update the details and press Place order again.', 'error');
                    return;
                }

                stripe.confirmPayment({
                    elements: elements,
                    confirmParams: {
                        return_url: window.location.origin + '/checkout/success/' + checkoutId
                    }
                }).then(function (result) {
                    if (result.error) {
                        setLoading(false);
                        $('#card-errors').text(result.error.message);
                        setMessage(result.error.message + ' — update the details and press Place order again.', 'error');
                        return;
                    }
                    markPaidAndRedirect(checkoutId);
                });
            });
        }

        function simulateCardPayment() {
            var number = ($('#card-number').val() || '').replace(/\s/g, '');
            var expiry = ($('#card-expiry').val() || '').trim();
            var cvc = ($('#card-cvc').val() || '').trim();
            var name = ($('#card-name').val() || '').trim();

            var demoErrors = [];
            if (number.length < 12) {
                fieldError('card-number', true);
                demoErrors.push('card-number');
            } else { fieldError('card-number', false); }
            if (!/^\s*\d{1,2}\s*\/\s*\d{2,4}\s*$/.test(expiry) || expired(expiry)) {
                fieldError('card-expiry', true);
                demoErrors.push('card-expiry');
            } else { fieldError('card-expiry', false); }
            if (cvc.length < 3) {
                fieldError('card-cvc', true);
                demoErrors.push('card-cvc');
            } else { fieldError('card-cvc', false); }
            if (!name) {
                fieldError('card-name', true);
                demoErrors.push('card-name');
            } else { fieldError('card-name', false); }

            if (demoErrors.length) {
                setLoading(false);
                document.getElementById(demoErrors[0]).focus();
                setMessage('Complete the card details to finish your order — in test mode use 4242 4242 4242 4242 with a future expiry.', 'error');
                return;
            }

            setTimeout(function () {
                markPaidAndRedirect(checkoutId);
            }, 900);
        }

        function expired(expiry) {
            var match = expiry.match(/^(\d{1,2})\s*\/\s*(\d{2,4})$/);
            if (!match) { return true; }
            var month = parseInt(match[1], 10);
            var year = parseInt(match[2].length === 2 ? '20' + match[2] : match[2], 10);
            if (month < 1 || month > 12) { return true; }
            return new Date(year, month, 0, 23, 59, 59) < new Date();
        }

        function markPaidAndRedirect(id) {
            $.ajax({
                url: '/checkout/' + id + '/paid',
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {},
                success: function () {
                    window.location.href = '/checkout/success/' + id;
                },
                error: function () {
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
