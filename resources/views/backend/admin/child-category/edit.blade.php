@extends('backend.admin.layouts.master')
@section('content')
     <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Update Child-Category</h1>
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
                    <h4>Update Child Category</h4>
                  </div>
                   <div class="card-body">
                    <form action="{{route('admin.child-category.update', $childCategory->id)}}" method="post">
                        @csrf
                        @method('put')

                        {{-- <div class="form-group">
                            <label class="mr-2">Icon</label>
                                <button class="btn btn-primary " data-selected-class="btn-danger"
                                data-unselected-class="btn-info" role="iconpicker" name="icon"></button>

                            <input type="text" class="form-control" name="icon" value="">
                          </div> --}}
                          <div class="row">
                          <div class="form-group col-md-6">
                            <label for="inputState">Category</label>
                            <select id="inputState" class="form-control main-category" name="category_id">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option {{$category->id==$childCategory->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputState">Sub Category</label>
                            <select id="inputState" class="form-control sub-category" name="sub_category_id">
                                <option value="">Select Sub Category</option>
                                @foreach ($subCategories as $subCategory)
                                <option {{$subCategory->id==$childCategory->sub_category_id ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>

                                @endforeach
                            </select>
                          </div>
                        </div>
                          <div class="row">
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{$childCategory->name}}">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$childCategory->status==1 ? 'selected' : ''}} value="1">Active</option>
                              <option {{$childCategory->status==0 ? 'selected' : ''}} value="0">Inactive</option>
                            </select>
                          </div>
                        </div>
                          <button type="submit" class="btn btn-primary mt-3" >Update</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>
        </section>

@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('change','.main-category', function(e){
                let id=$(this).val();
                $.ajax({
                    url: "{{route('admin.get-subCategories')}}",
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
        })
    </script>
@endpush

