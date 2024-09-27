<div class="tab-pane fade" id="productpage" role="tabpanel" aria-labelledby="list-productpage">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.adv.product-page-banner')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Banner url</label>
                        <input type="text" class="form-control" name="banner_url" value="{{$productpage_banner_section->banner_one->banner_url}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Banner Image</label>
                        <input type="file" class="form-control" name="banner_image" value="">
                        <input type="hidden" class="form-control" name="banner_old_image" value="{{$productpage_banner_section->banner_one->banner_image}}">
                    </div>
                    <div class="form-group col-md-6">
                       <img src="{{asset(@$productpage_banner_section->banner_one->banner_image)}}" alt="" width="150px">
                    </div>
                    <div class="form-group col-md-4 d-flex  align-items-center">
                        <label for="" class="mr-4 mb-0">Stauts</label>
                        <label class="custom-switch">
                            <input type="checkbox" {{$productpage_banner_section->banner_one->status == 1 ? 'checked' : ''}} name="status" class="custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                          </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
