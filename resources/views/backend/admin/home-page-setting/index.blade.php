@extends('backend.admin.layouts.master')
@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
        <h1>Home Page Setting</h1>
        {{-- <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Components</a></div>
            <div class="breadcrumb-item">Table</div>
        </div> --}}
        </div>

        <div class="section-body">

        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-2">
                        <div class="list-group" id="list-tab" role="tablist">
                        {{-- <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab">General Setting</a> --}}
                        <a class="list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab">Popular Category Section</a>
                        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab">Product Slider Section One</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab">Product Slider Section Two</a>
                        <a class="list-group-item list-group-item-action" id="list-list-slider-section-three" data-toggle="list" href="#list-slider-section-three" role="tab">Product Slider Section Three</a>
                        </div>
                    </div>
                    <div class="col-10 border">
                        <div class="tab-content" id="nav-tabContent">

                        <!-- General Setting -->
                        @include('backend.admin.home-page-setting.section.popular-category-section')

                        <!-- product category section one -->
                        @include('backend.admin.home-page-setting.section.product-slider-section-one')

                        <!-- product category section two -->
                        @include('backend.admin.home-page-setting.section.product-slider-section-two')
                        <!-- product category section three -->
                        @include('backend.admin.home-page-setting.section.product-slider-section-three')
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
@endsection

