@extends('backend.vendor.dashboard.layouts.master')
@section('title')
{{$settings->site_name}} || Create Product
@endsection
@section('content')
      <!--=============================
    DASHBOARD START
  ==============================-->
   <section id="wsus__dashboard">
    <div class="container-fluid">
      @include('backend.vendor.dashboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <div class="d-flex justify-content-between align-items-center">
                <h3><i class="far fa-user"></i> Product</h3>
                <div class="card-button">
                    <a href="{{route('vendor.products.index')}}" class="btn btn-primary  mb-3"><i class="fas fa-plus"></i> Back</a>
                </div>
            </div>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                {{-- <h4>basic information</h4> --}}

                    <form action="{{route('vendor.products.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group mb-3">
                        <label class="mb-1">Name</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        </div>
                        <div class="row  mb-3">
                        <div class="form-group col-md-4">
                            <label for="inputState" class="mb-1">Category</label>
                            <select id="inputState" class="form-control main-category" name="category">
                                <option value="">select category</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group col-md-4" >
                            <label for="inputState" class="mb-1">Sub Category</label>
                            <select id="inputState" class="form-control sub-category" name="sub_category">
                                <option value="">select</option>
                            </select>
                            </div>
                            <div class="form-group col-md-4" >
                            <label for="inputState" class="mb-1">Child Category</label>
                            <select id="inputState" class="form-control child-category" name="child_category">
                                <option value="">select</option>
                            </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                        <div class="form-group col-md-6" >
                        <label for="inputState" class="mb-1">Brand</label>
                        <select id="inputState" class="form-control" name="brand">
                            <option value="">Brands</option>
                            @foreach ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label class="mb-1">SKU</label>
                        <input type="text" class="form-control" name="sku" value="{{old('sku')}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                        <label class="mb-1">Price</label>
                        <input type="text" class="form-control" name="price" value="{{old('price')}}">
                        </div>
                        <div class="form-group col-md-6">
                        <label class="mb-1">Offer Price</label>
                        <input type="text" class="form-control" name="offer_price" value="{{old('offer_price')}}">
                        </div>
                    </div>
                        <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label class="mb-1">Offer Start Date</label>
                            <input type="text" class="form-control datepicker" name="offer_start_date" value="{{old('offer_start_date')}}">
                            </div>
                            <div class="form-group col-md-6">
                            <label class="mb-1">Offer End Date</label>
                            <input type="text" class="form-control datepicker" name="offer_end_date" value="{{old('offer_end_date')}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                        <div class="form-group col-md-6">
                        <label class="mb-1">Stock Quantity</label>
                        <input type="number" min="0" class="form-control" name="qty" value="{{old('qty')}}">
                        </div>
                        <div class="form-group col-md-6">
                        <label class="mb-1">Video Link </label>
                        <input type="text" class="form-control" name="video_link" value="{{old('video_link')}}">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1">Short Description</label>
                        <textarea name="short_description"   class="form-control"></textarea>
                        </div>
                    <div class="form-group mb-3">
                        <label class="mb-1">Long Description</label>
                        <textarea name="long_description"   class="form-control summernote"></textarea>
                        </div>
                        <div class="row mb-3">
                        <div class="form-group col-md-12">
                            <label class="mb-1">Seo Title</label>
                            <input type="text" class="form-control" name="seo_title" value="{{old('seo_title')}}">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mb-1">Seo Description</label>
                        <textarea name="seo_description"   class="form-control"></textarea>
                        </div>
                        <div class="row mb-3">
                        <div class="form-group col-md-6" >
                        <label for="inputState" class="mb-1">Status</label>
                        <select id="inputState" class="form-control" name="status">
                            <option value="">Select</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        </div>
                    <div class="form-group col-md-6">
                        <label class="mb-1">Image</label>
                        <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                        <button type="submit" class="btn btn-primary mt-3" >Create</button>
                    </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->
@endsection
@push('scripts')

<script>
    $(document).ready(function(){
        $('body').on('change','.main-category', function(e){
            let id=$(this).val();
            $.ajax({
                url: "{{route('vendor.product.get-sub-categories')}}",
                method: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('.sub-category').html('<option value="">Select Sub Category</option>');
                    $.each(data, function(i, item){
                        $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                    })
                },
                error: function(xhr, status, error) {
                    console.error('Error status:', status);
                    console.error('Error message:', error);
                    console.error('XHR object:', xhr);
                }
            });
        })

        /** get child categories */

        $('body').on('change','.sub-category', function(e){
            let id=$(this).val();
            $.ajax({
                url: "{{route('vendor.product.get-child-categories')}}",
                method: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('.child-category').html('<option value="">Select child Category</option>');
                    $.each(data, function(i, item){
                        $('.child-category').append(`<option value="${item.id}">${item.name}</option>`)
                    })
                },
                error: function(xhr, status, error) {
                    console.error('Error status:', status);
                    console.error('Error message:', error);
                    console.error('XHR object:', xhr);
                }
            });
        })
    })
</script>
@endpush
