@extends('client.layouts.app')

@section('title', 'Contact')
@section('meta', 'Questions about an order, delivery or a product? Send us a message — we reply within one business day.')

@section('content')


        <!-- Start page content -->
        <section id="page-content" class="page-wrapper section">

            <!-- ADDRESS SECTION START -->
            <div class="address-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="contact-address box-shadow">
                                <i class="zmdi zmdi-pin" aria-hidden="true"></i>
                                <p class="contact-address-line">2210 NW Marine Dr</p>
                                <p class="contact-address-line">Portland, OR 97203</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-address box-shadow">
                                <i class="zmdi zmdi-phone" aria-hidden="true"></i>
                                <p class="contact-address-line"><a href="tel:+15550100199">+1 555 010 0199</a></p>
                                <p class="contact-address-line">Mon–Fri, 9am to 5pm</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-address box-shadow">
                                <i class="zmdi zmdi-email" aria-hidden="true"></i>
                                <p class="contact-address-line"><a href="mailto:hello@example.com">hello@example.com</a></p>
                                <p class="contact-address-line">We reply within one business day</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ADDRESS SECTION END -->

            <!-- GOOGLE MAP SECTION START -->
            <div class="google-map-section pr-200">
                <div class="container-fluid ">
                    <div class="google-map plr-185">
                        <div id="googleMapp" >
                            <iframe title="Our shop location on Google Maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3305.958757822714!2d-5.001345625449448!3d34.04492901811847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd9f8bea1f782563%3A0x813ed7905fe029f!2sImag&#39;in%20Creative%20%3A%20Agence%20Web%2C%20Publicit%C3%A9%20et%20Communication!5e0!3m2!1sen!2sma!4v1709370524897!5m2!1sen!2sma" width="1260" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                        </div>
                    </div>
                </div>
            </div>
            <!-- GOOGLE MAP SECTION END -->

            <!-- MESSAGE BOX SECTION START -->
            <div class="message-box-section mt--50 mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="message-box box-shadow white-bg">
                                <form id="contact-form" method="POST" action="{{ route('contact.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h1 class="blog-section-title border-left mb-30">Get in touch</h1>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="ecom-field">
                                                <label for="con-name">Your name</label>
                                                <input type="text" id="con-name" name="con_name" required spellcheck="false" autocomplete="name" placeholder="Alex Morgan">
                                                <p class="ecom-field-error" id="con-name-error" hidden>Tell us who is asking.</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="ecom-field">
                                                <label for="con-email">Email address</label>
                                                <input type="email" id="con-email" name="con_email" required spellcheck="false" autocomplete="email" inputmode="email" placeholder="you@example.com">
                                                <p class="ecom-field-error" id="con-email-error" hidden>We need your email to reply — check the format, e.g. you@example.com.</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="ecom-field">
                                                <label for="con-subject">Subject <span class="ecom-optional">(optional)</span></label>
                                                <input type="text" id="con-subject" name="con_subject" placeholder="Order #123 question">
                                                <p class="ecom-field-error" id="con-subject-error" hidden></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="ecom-field">
                                                <label for="con-phone">Phone <span class="ecom-optional">(optional)</span></label>
                                                <input type="tel" id="con-phone" name="con_phone" autocomplete="tel" inputmode="tel" spellcheck="false" placeholder="+1 555 010 0199">
                                                <p class="ecom-field-error" id="con-phone-error" hidden></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="ecom-field">
                                                <label for="con-message">Message</label>
                                                <textarea class="custom-textarea" id="con-message" name="con_message" required
                                                    placeholder="How can we help?"></textarea>
                                                <p class="ecom-field-error" id="con-message-error" hidden>Give us a few words so we can help.</p>
                                            </div>
                                            <button class="submit-btn-1 mt-30 btn-hover-1" type="submit">Send
                                                message</button>
                                        </div>
                                    </div>
                                    <p class="form-message mt-20" role="status" aria-live="polite">@if (session('success')) {{ session('success') }} @endif</p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MESSAGE BOX SECTION END -->
        </section>
        <!-- End page content -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#contact-form').on('submit', function (e) {
            e.preventDefault();
            var form = $(this);
            var required = [
                { id: 'con-name', ok: function (v) { return v !== ''; } },
                { id: 'con-email', ok: function (v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); } },
                { id: 'con-message', ok: function (v) { return v !== ''; } }
            ];
            var firstInvalid = null;

            required.forEach(function (field) {
                var value = ($('#' + field.id).val() || '').trim();
                var valid = field.ok(value);
                $('#' + field.id).attr('aria-invalid', valid ? 'false' : 'true');
                $('#' + field.id + '-error').prop('hidden', valid);
                if (!valid && !firstInvalid) { firstInvalid = document.getElementById(field.id); }
            });

            var message = $('.form-message', form);
            if (firstInvalid) {
                firstInvalid.focus();
                message.text('Fill in the highlighted fields and send again.').css('color', 'var(--ecom-danger)');
                return;
            }

            var button = $('button[type="submit"]', form);
            button.prop('disabled', true);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: form.serialize(),
                success: function (response) {
                    message.text(response.message || 'Thanks — your message reached us.').css('color', 'var(--ecom-success)');
                    $('#con-name, #con-email, #con-subject, #con-phone, #con-message').val('');
                },
                error: function (xhr) {
                    var text = 'Could not send your message right now — please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        var map = { con_name: 'con-name', con_email: 'con-email', con_message: 'con-message' };
                        var first = null;
                        Object.keys(map).forEach(function (key) {
                            if (errors[key]) {
                                $('#' + map[key]).attr('aria-invalid', 'true');
                                $('#' + map[key] + '-error').text(errors[key][0]).prop('hidden', false);
                                first = first || document.getElementById(map[key]);
                            }
                        });
                        if (first) { first.focus(); }
                        text = 'Fill in the highlighted fields and send again.';
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        text = xhr.responseJSON.message;
                    }
                    message.text(text).css('color', 'var(--ecom-danger)');
                },
                complete: function () { button.prop('disabled', false); }
            });
        });
    });
</script>


@endsection
