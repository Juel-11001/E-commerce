@extends('backend.vendor.dashboard.layouts.master')
@section('title')
{{$settings->site_name}} || Product Variant
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
            <div class="card-header-action">
                <a href="{{route('vendor.products.index')}}" class="btn btn-warning mb-3"><i class="fas fa-caret-left"></i> Back</a>
            </div>
          <div class="dashboard_content mt-2 mt-md-0">
            <div class="d-flex justify-content-between align-items-center">
                <h3><i class="far fa-user"></i> Product Variant</h3>

                <div class="card-button">
                    <a href="{{route('vendor.products-variant.create', ['product'=>$product->id])}}" class="btn btn-primary  mb-3"><i class="fas fa-plus"></i> Create Variant</a>
                </div>
            </div>
            <h5 class="mb-3">Product : {{$product->name}}</h5>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                {{-- <h4>basic information</h4> --}}
                {{ $dataTable->table() }}
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
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script>
    $(document).ready(function(){
        $('body').on('click', '.change-status', function(){
            let isChecked=$(this).is(':checked');
            let id = $(this).data('id');
            $.ajax({
                url: "{{route('vendor.products-variant.change-status')}}",
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
