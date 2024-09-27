@extends('backend.admin.layouts.master')
@section('content')
     <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Product Image Gallery</h1>
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
                        <div class="card-header">
                            <h4>Product : {{$product->name}}</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.products.index')}}" class="btn btn-primary"><i class="fas fa-caret-left mr-1"></i>  Back</a>
                            </div>
                        </div>
                   <div class="card-body">
                    <form action="{{route('admin.products-image-gallery.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Image <code>(Multi Image Supported!)</code></label>
                            <input type="file" name="image[]" class="form-control" multiple>
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Products Image Gallery</h4>

                  </div>
                   <div class="card-body">
                    {{ $dataTable->table() }}
                  </div>
                </div>
              </div>
          </div>
        </div>
        </section>
@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
