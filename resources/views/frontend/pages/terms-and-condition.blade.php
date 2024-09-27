@extends('frontend.layouts.master')
@section('title')
    {{$settings->site_name}} || Terms and Condition
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
                        <h4>Terms and Condtion</h4>
                        <ul>
                            <li><a href="{{route('fronted.home')}}">home</a></li>
                            <li><a href="#">Terms and Condtion</a></li>
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
                <div class="col-xl-12">
                    <div class="wsus__terms_text">
                        {!!@ $terms->content!!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        TERMS & CONDITION END
    ==============================-->
@endSection
