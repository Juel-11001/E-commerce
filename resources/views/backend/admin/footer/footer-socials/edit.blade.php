@extends('backend.admin.layouts.master')
@section('content')
     <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Footer Social</h1>
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
                    <h4>Update Social</h4>
                    <div class="card-header-action">
                        <a href="{{route('admin.footer-socials.index')}}" class="btn btn-primary "><i class="fas fa-caret-left mr-1"></i> <span class="d-none d-md-inline">Back</span> </a>
                    </div>
                  </div>
                   <div class="card-body">
                    <form action="{{route('admin.footer-socials.update', $footerSocial->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label class="mr-2">Icon</label>
                                <button class="btn btn-primary " data-selected-class="btn-danger"
                                data-icon="{{$footerSocial->icon}}"
                                data-unselected-class="btn-info" role="iconpicker" name="icon"></button>

                            {{-- <input type="text" class="form-control" name="icon" value=""> --}}
                          </div>

                        <div class="form-group col-md-12">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{$footerSocial->name}}">
                          </div>
                        <div class="form-group col-md-6">
                            <label>url</label>
                            <input type="text" class="form-control" name="url" value="{{$footerSocial->url}}">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$footerSocial->status === 1 ? 'select' : ''}} value="1">Active</option>
                              <option {{$footerSocial->status === 0 ? 'select' : ''}} value="0">Inactive</option>
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

