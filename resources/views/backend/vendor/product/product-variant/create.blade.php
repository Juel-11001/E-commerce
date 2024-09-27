@extends('backend.vendor.dashboard.layouts.master')
@section('title')
{{$settings->site_name}} || Create Variant
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
                <h3><i class="far fa-user"></i> Create Variant</h3>
                <div class="card-button">
                    <a href="{{route('vendor.products-variant.index', ['product'=>request()->product])}}" class="btn btn-primary  mb-3"><i class="fas fa-arrow-left"></i>Back</a>
                </div>
            </div>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                {{-- <h4>basic information</h4> --}}
                <form action="{{route('vendor.products-variant.store')}}" method="post">
                    @csrf
                      <div class="row">
                    <div class="form-group wsus_input">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                      </div>
                    <div class="form-group ">

                        <input type="hidden" class="form-control" name="product_id" value="{{request()->product}}">
                      </div>
                      <div class="form-group wsus_input">
                        <label for="inputState">Status</label>
                        <select id="inputState" class="form-control" name="status">
                          <option value="">Select</option>
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
        $('body').on('click', '.change-status', function(){
            let isChecked=$(this).is(':checked');
            let id = $(this).data('id');
            $.ajax({
                url: "{{route('admin.products.change-status')}}",
                method:'put',
                data: {
                    id: id,
                    status: isChecked
                },
                success: function(data){
                    toastr.success(data.message)
                },
                error: function(xhr, status,error){
                    console.log(error);
                }
            })
        })
    })
</script>
@endpush
