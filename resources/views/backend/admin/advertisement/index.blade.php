@extends('backend.admin.layouts.master')
@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
        <h1>Advertisement</h1>
        </div>
        <div class="section-body">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-2">
                        <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-homepage-one-list" data-toggle="list" href="#list-homepage-one" role="tab">Homepage banner section one</a>
                        <a class="list-group-item list-group-item-action" id="list-homepage-two" data-toggle="list" href="#list-homepage-two-list" role="tab">Homepage banner section two</a>
                        <a class="list-group-item list-group-item-action" id="list-homepage-three" data-toggle="list" href="#list-homepage-three-list" role="tab">Homepage banner section three</a>
                        <a class="list-group-item list-group-item-action" id="list-homepage-four" data-toggle="list" href="#list-homepage-four-list" role="tab">Homepage banner section four</a>
                        <a class="list-group-item list-group-item-action" id="list-productpage" data-toggle="list" href="#productpage" role="tab">Productpage banner section</a>
                        <a class="list-group-item list-group-item-action" id="list-cartpage-banner" data-toggle="list" href="#list-cartpage-banner-section" role="tab">Cartpage banner section</a>
                        </div>
                    </div>

                    <div class="col-10">

                        <div class="tab-content" id="nav-tabContent">
                        <!-- Homepage banner section one -->
                        @include('backend.admin.advertisement.homepage-banner-section-one')
                        <!-- Homepage banner section two -->
                        @include('backend.admin.advertisement.homepage-banner-section-two')
                        <!-- Homepage banner section two -->
                        @include('backend.admin.advertisement.homepage-banner-section-three')
                        <!-- Homepage banner section two -->
                        @include('backend.admin.advertisement.homepage-banner-section-four')
                        <!-- Productpage banner section -->
                        @include('backend.admin.advertisement.productpage-banner-section')
                        <!-- Cartpage banner section -->
                        @include('backend.admin.advertisement.cartpage-banner-section')
                        </div>
                    </div>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
@endsection
