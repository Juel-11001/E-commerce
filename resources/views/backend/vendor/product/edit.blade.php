@extends('backend.vendor.dashboard.layouts.master')
@section('title')
{{$settings->site_name}} || Update Product
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
                <h3><i class="far fa-user"></i> Product Update</h3>
                <div class="card-button">
                    <a href="{{route('vendor.products.index')}}" class="btn btn-primary  mb-3"><i class="fas fa-caret-left"></i> Back</a>
                </div>
            </div>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                {{-- <h4>basic information</h4> --}}

                    <form action="{{route('vendor.products.update', $product->id)}}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                    <div class="form-group mb-3">
                        <label class="mb-1">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$product->name}}">
                        </div>
                        <div class="row  mb-3">
                        <div class="form-group col-md-4">
                            <label for="inputState" class="mb-1">Category</label>
                            <select id="inputState" class="form-control main-category" name="category">
                                <option value="">select category</option>
                                @foreach ($categories as $category)
                                <option {{$product->category_id == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group col-md-4" >
                            <label for="inputState" class="mb-1">Sub Category</label>
                            <select id="inputState" class="form-control sub-category" name="sub_category">
                                <option value="">select</option>
                                @foreach ($subCategories as $sub_category)
                                <option {{$sub_category->id == $product->sub_category_id ? 'selected' : ''}} value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group col-md-4" >
                            <label for="inputState" class="mb-1">Child Category</label>
                            <select id="inputState" class="form-control child-category" name="child_category">
                               <option value="">select</option>
                                @foreach ($childCategories as $childCategory)
                                <option {{$childCategory->id == $product->child_category_id ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                        <div class="form-group col-md-6" >
                        <label for="inputState" class="mb-1">Brand</label>
                        <select id="inputState" class="form-control" name="brand">
                            <option value="">Brands</option>
                            @foreach ($brands as $brand)
                            <option {{$product->brand_id == $brand->id ? 'selected' : ''}} value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label class="mb-1">SKU</label>
                        <input type="text" class="form-control" name="sku" value="{{$product->sku}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                        <label class="mb-1">Price</label>
                        <input type="text" class="form-control" name="price" value="{{$product->price}}">
                        </div>
                        <div class="form-group col-md-6">
                        <label class="mb-1">Offer Price</label>
                        <input type="text" class="form-control" name="offer_price" value="{{$product->offer_price}}">
                        </div>
                    </div>
                        <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label class="mb-1">Offer Start Date</label>
                            <input type="text" class="form-control datepicker" name="offer_start_date" value="{{$product->offer_start_date}}">
                            </div>
                            <div class="form-group col-md-6">
                            <label class="mb-1">Offer End Date</label>
                            <input type="text" class="form-control datepicker" name="offer_end_date" value="{{$product->offer_end_date}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                        <div class="form-group col-md-6">
                        <label class="mb-1">Stock Quantity</label>
                        <input type="number" min="0" class="form-control" name="qty" value="{{$product->qty}}">
                        </div>
                        <div class="form-group col-md-6">
                        <label class="mb-1">Video Link </label>
                        <input type="text" class="form-control" name="video_link" value="{{$product->video_link}}">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1">Short Description</label>
                        <textarea name="short_description"   class="form-control">{!! $product->short_description !!}</textarea>
                        </div>
                    <div class="form-group mb-3">
                        <label class="mb-1">Long Description</label>
                        <textarea name="long_description"   class="form-control summernote">{!! $product->long_description !!}</textarea>
                        </div>
                        <div class="row mb-3">
                        <div class="form-group col-md-12">
                            <label class="mb-1">Seo Title</label>
                            <input type="text" class="form-control" name="seo_title" value="{{$product->seo_title}}">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mb-1">Seo Description</label>
                        <textarea name="seo_description"   class="form-control">{!! $product->seo_description !!}</textarea>
                        </div>
                        <div class="row mb-3">
                        <div class="form-group col-md-6" >
                        <label for="inputState" class="mb-1">Status</label>
                        <select id="inputState" class="form-control" name="status">
                            <option value="">Select</option>
                            <option {{$product->status==1? 'selected': ''}} value="1">Active</option>
                            <option {{$product->status==0? 'selected': ''}} value="0">Inactive</option>
                        </select>
                        </div>
                    <div class="form-group col-md-6">
                        <label class="mb-1">Image</label>
                        <input type="file" class="form-control" name="image">
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="mr-5">Preview</label>
                        <img src="{{asset($product->thumb_image)}}"  alt="" width="150px">
                      </div>
                        <button type="submit" class="btn btn-primary mt-3" >Update</button>
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
            $('.child-category').html('<option value="">Select child Category</option>');
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
