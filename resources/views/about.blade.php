@extends('client.layouts.app')

@section('title', 'About us')
@section('meta', 'About our shop — who we are and what we stand for.')

@section('content')


<!-- Start page content -->
<section id="page-content" class="page-wrapper section">

    <!-- ABOUT SECTION START -->
    <div class="about-section mb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-start ">
                        <h1 class="uppercase">{{$aboutt->titre}}</h1>
                        <p class="section-sub mb-40">{{$aboutt->sous_titre}}</p>
                    </div>
                </div>
            </div>                    
            <div class="row">
                <div class="col-lg-5">
                    <div class="about-photo p-20 bg-img-1">
                        <img src="{{ asset($aboutt->image)}}" alt="Inside our shop" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="about-description mt-50">
                        {{$aboutt->description}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ABOUT SECTION END --> 

    <!-- TEAM SECTION END -->             
</section>
<!-- End page content -->

@endsection