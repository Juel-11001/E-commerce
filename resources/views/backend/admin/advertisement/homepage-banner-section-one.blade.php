<div class="tab-pane fade show active" id="list-homepage-one" role="tabpanel" aria-labelledby="list-homepage-one-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.adv.homepage-banner-section-one')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Banner url</label>
                        <input type="text" class="form-control" name="banner_url" value="{{$homepage_banner_section_one->banner_one->banner_url}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Banner Image</label>
                        <input type="file" class="form-control" name="banner_image" value="">
                        <input type="hidden" class="form-control" name="banner_old_image" value="{{$homepage_banner_section_one->banner_one->banner_image}}">
                    </div>
                    <div class="form-group col-md-6">
                       <img src="{{asset(@$homepage_banner_section_one->banner_one->banner_image)}}" alt="" width="150px" class="mt-4">
                    </div>
                    <div class="form-group col-md-4 d-flex  align-items-center">
                        <label for="" class="mr-4 mb-0">Stauts</label>
                        <label class="custom-switch">
                            <input type="checkbox" {{$homepage_banner_section_one->banner_one->status == 1 ? 'checked' : ''}} name="status" class="custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                          </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
