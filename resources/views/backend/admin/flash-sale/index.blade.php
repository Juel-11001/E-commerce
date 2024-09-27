@extends('backend.admin.layouts.master')
@section('content')
<!-- Main Content -->
<section class="section">
    <div class="section-header">
    <h1>Flash Sale</h1>
    </div>
    <div class="section-body">
    <div class="row">
        <div class="col-md-6">
        <div class="card">
            <div class="card-header">
            <h4>Flash Sale End Date</h4>
            </div>
            <div class="card-body">
                <form action="{{route('admin.flash-sale.update')}}" method="post">
                    @csrf
                    @method('put')
                <div class="form-group">
                <label for="">Date Picker</label>
                <input type="text" id="datepicker" class="form-control datepicker" name="end_date" value="{{@$flash_sale->end_date}}">
                </div>
            <button type="submit" class="btn btn-primary">Save</button>
            </form>
            </div>
        </div>
        </div>

        <div class="col-md-6">
        <div class="card">
            <div class="card-header">
            <h4>Add Flash Sale Product</h4>
            </div>
            <div class="card-body">
            <form action="{{route('admin.flash-sale.add-product')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Add Product</label>
                    <select name="product" id="" class="form-control select2">
                        <option value="">Select</option>
                        @foreach ($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <button type="submit" class="btn btn-primary">Save</button> --}}
            {{-- </form> --}}
            </div>
        </div>
        </div>
    </div>
</div>
{{-- <div class="section-body"> --}}

        {{-- <div class="row">

        <div class="col-md-6">


                        <div class="form-group">
                            <label for="">Show At Home?</label>
                            <select name="show_at_home" id="" class="form-control ">
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>

                            </select>
                        </div>


                </div>


        <div class="col-md-6">
            <div class="form-group">
                <label for="">Status</label>
                <select name="status" id="" class="form-control">
                    <option value="">Select</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>

                </select>
            </div>
                </div>

            <button type="submit" class="btn btn-primary">Save</button>
            </form>

    </div> --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Show At Home?</label>
                                <select name="show_at_home" id="" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-body">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h4>All Flash Sale Products</h4>
            {{-- <div class="card-header-action">
                <a href="{{route('admin.products.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New</a>
            </div> --}}
            </div>
            <div class="card-body">
            {{ $dataTable->table() }}
            </div>
        </div>
        </div>
    </div>
    </div>
</section>
@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script>
    $(document).ready(function(){
        $('body').on('click', '.change-status', function(){
            let isChecked=$(this).is(':checked');
            let id = $(this).data('id');
            $.ajax({
                url: "{{route('admin.flash-sale.change-status')}}",
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

        //show at home :
        $('body').on('click', '.show_at_home', function(){
            let isChecked=$(this).is(':checked');
            let id = $(this).data('id');
            $.ajax({
                url: "{{route('admin.flash-sale.show_at_home.change-status')}}",
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
