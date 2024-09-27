@extends('backend.admin.layouts.master')
@section('content')
     <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Product Variant Item</h1>
            {{-- <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Components</a></div>
              <div class="breadcrumb-item">Table</div>
            </div> --}}
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                {{-- <div class="mb-3 ml-3">
                    <a href="{{route('admin.products-variant-item.index', ['productId'=>$product->id, 'variantId'=>$variant->id])}}" class="btn btn-primary "><i class="fas fa-caret-left mr-1"></i> <span class="d-none d-md-inline">Back</span> </a>
                </div> --}}
                <div class="card">
                  <div class="card-header">
                    <h4>Create Product Variant Item</h4>
                  </div>
                   <div class="card-body">
                    <form action="{{route('admin.products-variant-item.store')}}" method="post">
                        @csrf
                          <div class="row">
                        <div class="form-group col-md-6">
                            <label>Variant Name</label>
                            <input type="text" class="form-control" name="variant_name" value="{{$variant->name}}" readonly>
                          </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="variant_id" value="{{$variant->id}}">
                          </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="product_id" value="{{$product->id}}">
                          </div>
                          <div class="form-group col-md-6">
                              <label>Item Name</label>
                              <input type="text" class="form-control" name="name" value="{{old('name')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Price <code>(set 0 for free)</code></label>
                            <input type="text" class="form-control" name="price" value="{{old('price')}}">
                          </div>
                          <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status">
                                  <option value="1">Active</option>
                                  <option value="0">Inactive</option>
                                </select>
                              </div>
                              <div class="form-group col-md-6">
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
        </section>

@endsection


