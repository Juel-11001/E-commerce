@extends('backend.vendor.dashboard.layouts.master')
@section('title')
{{$settings->site_name}} || Create Variant Item
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
                <h3><i class="far fa-user"></i> Create Variant Item</h3>
                <div class="card-button">
                    <a href="{{route('vendor.products-variant-item.index', ['productId'=>$product->id, 'variantId'=>$variant->id])}}" class="btn btn-primary  mb-3"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                {{-- <h4>basic information</h4> --}}
                <form action="{{route('vendor.products-variant-item.store')}}" method="post">
                    @csrf
                      <div class="row">
                    <div class="form-group col-md-6 wsus__input">
                        <label>Variant Name</label>
                        <input type="text" class="form-control" name="variant_name" value="{{$variant->name}}" readonly>
                      </div>

                      <div class="form-group col-md-6 wsus__input">
                          <label>Item Name</label>
                          <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="variant_id" value="{{$variant->id}}">
                      </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="product_id" value="{{$product->id}}">
                      </div>
                    <div class="form-group wsus_input">
                        <label>Price <code>(set 0 for free)</code></label>
                        <input type="text" class="form-control" name="price" value="{{old('price')}}">
                      </div>
                      <div class="row">
                        <div class="form-group col-md-6 wsus__input">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                                <option value="">Select</option>
                                <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>
                          </div>
                          <div class="form-group col-md-6 wsus__input">
                            <label for="inputState">Is Default</label>
                            <select id="inputState" class="form-control" name="is_default">
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
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
