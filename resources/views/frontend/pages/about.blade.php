@extends('frontend.layouts.master')
@section('title')
    {{$settings->site_name}} || About Us
@endsection
@section('content')
     <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>About Us</h4>
                        <ul>
                            <li><a href="{{route('fronted.home')}}">home</a></li>
                            <li><a href="#">About Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        TERMS & CONDITION START
    ==============================-->
    <section id="wsus__terms_condition">
        <div class="container">
            <div class="row">
                {{-- <div class="col-xl-12">
                    <h2>About Us</h2>
                </div> --}}
                <div class="col-xl-12">
                    <div class="wsus__terms_text">
                        {!!@ $about->content!!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        TERMS & CONDITION END
    ==============================-->
@endSection
