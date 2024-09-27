@extends('backend.admin.layouts.master')
@section('content')
     <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Manage User</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create User</h4>
                  </div>
                   <div class="card-body">
                    <form action="{{route('admin.manage-user.create')}}" method="post">
                        @csrf
                          <div class="row">
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="">
                          </div>
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="">
                          </div>
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" value="">
                          </div>
                        <div class="form-group col-md-6">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" value="">
                          </div>
                          <div class="form-group col-md-12">
                            <label for="inputState">Role</label>
                            <select id="inputState" class="form-control" name="role">
                              <option value="">Select</option>
                              <option value="user">User</option>
                              <option value="vendor">Vendor</option>
                              <option value="admin">Admin</option>
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

