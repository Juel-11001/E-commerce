@extends('backend.admin.layouts.master')
@section('content')
     <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Footer</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Update Grid Two</h4>
                    <div class="card-header-action">
                        <a href="{{route('admin.footer-grid-two.index')}}" class="btn btn-primary "><i class="fas fa-caret-left mr-1"></i> <span class="d-none d-md-inline">Back</span> </a>
                    </div>
                  </div>
                   <div class="card-body">
                    <form action="{{route('admin.footer-grid-two.update', $footerGridTwo->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>url</label>
                                <input type="text" class="form-control" name="url" value="{{$footerGridTwo->url}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{$footerGridTwo->name}}">
                              </div>
                          <div class="form-group col-md-6">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$footerGridTwo->status === 1 ? 'select' : ''}} value="1">Active</option>
                              <option {{$footerGridTwo->status === 0 ? 'select' : ''}} value="0">Inactive</option>
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

