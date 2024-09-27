@extends('backend.admin.layouts.master')
@section('content')
     <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Withdraw Method</h1>
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
                    <h4>Create Method</h4>
                  </div>
                   <div class="card-body">
                    <form action="{{route('admin.withdraw-method.store')}}" method="post">
                        @csrf
                          <div class="row">
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Withdraw Charge (<code>%</code>)</label>
                            <input type="text" class="form-control" name="withdraw_charge" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Minimum Amount</label>
                            <input type="text" class="form-control" name="minimum_amount" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Maximum Amount</label>
                            <input type="text" class="form-control" name="maximum_amount" value="">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea name="description" id="" cols="30" rows="10" class="summernote"></textarea>
                        </div>
                    </div>
                          <button type="submit" class="btn btn-primary" >Create</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>
        </section>

@endsection

