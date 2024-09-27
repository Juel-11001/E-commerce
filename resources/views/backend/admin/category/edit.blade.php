@extends('backend.admin.layouts.master')
@section('content')
     <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Category</h1>
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
                    <h4>Update Category</h4>
                  </div>
                   <div class="card-body">
                    <form action="{{route('admin.category.update', $category->id)}}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label class="mr-2">Icon</label>
                                <button class="btn btn-primary "
                                data-icon="{{$category->icon}}"
                                data-selected-class="btn-danger"
                                data-unselected-class="btn-info" role="iconpicker" name="icon" value=""></button>

                            {{-- <input type="text" class="form-control" name="icon" value=""> --}}
                          </div>
                          <div class="row">
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{$category->name}}">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                                <option {{$category->status ==1 ? 'selected': ''}} value="1">Active</option>
                                <option {{$category->status ==0 ? 'selected': ''}} value="0">Inactive</option>
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

