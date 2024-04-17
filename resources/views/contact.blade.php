@extends('client.layouts.app')

@section('content')

        
        <!-- Start page content -->
        <section id="page-content" class="page-wrapper section">

            <!-- ADDRESS SECTION START -->
            <div class="address-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="contact-address box-shadow">
                                <i class="zmdi zmdi-pin"></i>
                                <h6>Your address goes here.</h6>
                                <h6>Your address goes here.</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-address box-shadow">
                                <i class="zmdi zmdi-phone"></i>
                                <h6><a href="tel:0123456789">0123456789</a></h6>
                                <h6><a href="tel:0123456789">0123456789</a></h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-address box-shadow">
                                <i class="zmdi zmdi-email"></i>
                                <h6>demo@example.com</h6>
                                <h6>demo@example.com</h6>
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
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3305.958757822714!2d-5.001345625449448!3d34.04492901811847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd9f8bea1f782563%3A0x813ed7905fe029f!2sImag&#39;in%20Creative%20%3A%20Agence%20Web%2C%20Publicit%C3%A9%20et%20Communication!5e0!3m2!1sen!2sma!4v1709370524897!5m2!1sen!2sma" width="1260" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                        </div>
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
                                <form id="contact-form" action="https://whizthemes.com/mail-php/other/mail.php">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 class="blog-section-title border-left mb-30">get in touch</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" name="con_name" placeholder="Your name here">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" name="con_email" placeholder="Your email here">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" name="con_subject" placeholder="Subject here">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" name="con_phone" placeholder="Your phone here">
                                        </div>
                                        <div class="col-lg-12">
                                            <textarea class="custom-textarea" name="con_message"
                                                placeholder="Message"></textarea>
                                            <button class="submit-btn-1 mt-30 btn-hover-1" type="submit">submit
                                                message</button>
                                        </div>
                                    </div>
                                    <p class="form-message"></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MESSAGE BOX SECTION END -->
        </section>
        <!-- End page content -->


@endsection