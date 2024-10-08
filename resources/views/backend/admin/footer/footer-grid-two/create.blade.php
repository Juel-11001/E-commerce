@extends('backend.admin.layouts.master')
@section('content')
     <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Footer</h1>
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
                    <h4>Create Grid Two</h4>
                  </div>
                   <div class="card-body">
                    <form action="{{route('admin.footer-grid-two.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>url</label>
                                <input type="text" class="form-control" name="url" value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="">
                              </div>
                          <div class="form-group col-md-6">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
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

