<div class="tab-pane fade" id="list-homepage-four-list" role="tabpanel" aria-labelledby="list-homepage-four">
    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
        <form action="{{ route('admin.adv.homepage-banner-section-four')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Card for Banner One -->
            <div class="card border mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Banner URL</label>
                            <input type="text" class="form-control" name="banner_one_url" value="{{ $homepage_banner_section_four->banner_one->banner_one_url}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Banner Image</label>
                            <input type="file" class="form-control" name="banner_one_image">
                            <input type="hidden" class="form-control" name="banner_one_old_image" value="{{ $homepage_banner_section_four->banner_one->banner_one_image}}">
                        </div>
                        <div class="form-group col-md-6">
                            <img src="{{ asset($homepage_banner_section_four->banner_one->banner_one_image) }}" alt="" width="150px">
                        </div>
                        <div class="form-group col-md-4 d-flex align-items-center">
                            <label for="" class="mr-4 mb-0">Status</label>
                            <label class="custom-switch">
                                <input type="checkbox" {{ $homepage_banner_section_four->banner_one->banner_one_status == 1 ? 'checked' : '' }} name="banner_one_status" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>

        </form>
    </div>

</div>
