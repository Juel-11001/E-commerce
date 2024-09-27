<div class="tab-pane fade" id="list-cartpage-banner-section" role="tabpanel" aria-labelledby="list-cartpage-banner">
    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
        <form action="{{ route('admin.adv.cartpage-banner-section')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Card for Banner One -->
            <div class="card border mb-4">
                <div class="card-header">
                    <h4>Banner One</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Banner URL</label>
                            <input type="text" class="form-control" name="banner_one_url" value="{{ $cartpage_banner_section->banner_one->banner_one_url}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Banner Image</label>
                            <input type="file" class="form-control" name="banner_one_image">
                            <input type="hidden" class="form-control" name="banner_one_old_image" value="{{ $cartpage_banner_section->banner_one->banner_one_image}}">
                        </div>
                        <div class="form-group col-md-6">
                            <img src="{{ asset($cartpage_banner_section->banner_one->banner_one_image) }}" alt="" width="150px">
                        </div>
                        <div class="form-group col-md-4 d-flex align-items-center">
                            <label for="" class="mr-4 mb-0">Status</label>
                            <label class="custom-switch">
                                <input type="checkbox" {{ $cartpage_banner_section->banner_one->banner_one_status == 1 ? 'checked' : '' }} name="banner_one_status" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card for Banner Two -->
            <div class="card border">
                <div class="card-header">
                    <h4>Banner Two</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Banner URL</label>
                            <input type="text" class="form-control" name="banner_two_url" value="{{ $cartpage_banner_section->banner_two->banner_two_url}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Banner Image</label>
                            <input type="file" class="form-control" name="banner_two_image">
                            <input type="hidden" class="form-control" name="banner_two_old_image" value="{{ $cartpage_banner_section->banner_two->banner_two_image}}">
                        </div>
                        <div class="form-group col-md-6">
                            <img src="{{ asset($cartpage_banner_section->banner_two->banner_two_image) }}" alt="" width="150px">
                        </div>
                        <div class="form-group col-md-4 d-flex align-items-center">
                            <label for="" class="mr-4 mb-0">Status</label>
                            <label class="custom-switch">
                                <input type="checkbox" {{ $cartpage_banner_section->banner_two->banner_two_status == 1 ? 'checked' : '' }} name="banner_two_status" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </div>
                    </div>

                </div>
            </div>
            <div class="form-group ml-4">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>

    </div>

</div>
