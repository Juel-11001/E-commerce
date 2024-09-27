@extends('backend.admin.layouts.master')
@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
        <h1>Settings</h1>
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
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab">General Setting</a>
                        <a class="list-group-item list-group-item-action" id="list-email-config-list" data-toggle="list" href="#list-email-config" role="tab">Email Configuration</a>
                        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab">Logo and Favicon</a>

                        </div>
                    </div>
                    <div class="col-10 border">
                        <div class="tab-content" id="nav-tabContent">
                        <!-- General Setting -->
                        @include('backend.admin.settings.general-setting')

                        <!-- Email Configuration -->
                        @include('backend.admin.settings.email-configuration')

                        <!-- Logo Configuration -->
                        @include('backend.admin.settings.logo-setting')
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
@endsection

