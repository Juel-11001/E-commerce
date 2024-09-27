@php
    $popular_category_section=json_decode($popularCategorySection->value);
    // dd($popular_category_section);
@endphp
<div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
    <form action="{{route('admin.popular-category-section')}}" method="post">
        @csrf
        @method('PUT')
        <h5>Category 1</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group" >
                    <label for="inputState">Category</label>
                    <select id="inputState" class="form-control main-category" name="cat_one">
                      <option value="">Select</option>
                      @foreach ($categories as $category)
                      <option {{$category->id == $popular_category_section[0]->category ? 'selected' : ''}} value="{{ $category->id}}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" >
                    @php
                        $subCategories= \App\Models\SubCategory::where('category_id',$popular_category_section[0]->category)->get();
                    @endphp
                    <label for="inputState">Sub Category</label>
                    <select id="inputState" class="form-control sub-category" name="sub_cat_one">
                      <option value="">Select</option>
                      @foreach ($subCategories as $subCategory)
                      <option {{$subCategory->id == $popular_category_section[0]->sub_category ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" >
                    @php
                        $childCategories= \App\Models\ChildCategory::where('sub_category_id',$popular_category_section[0]->sub_category)->get();
                        // dd($childCategories);
                    @endphp
                    <label for="inputState">Child Category</label>
                    <select id="inputState" class="form-control child-category" name="child_cat_one">
                      <option value="">Select</option>
                      @foreach ($childCategories as $childCategory)
                      <option {{$childCategory->id == $popular_category_section[0]->child_category ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                      @endforeach
                    </select>
                </div>
            </div>
        </div>
        <h5>Category 2</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group" >
                    @php
                        $subCategories= \App\Models\SubCategory::where('category_id',$popular_category_section[1]->category)->get();
                    @endphp
                    <label for="inputState">Category</label>
                    <select id="inputState" class="form-control main-category" name="cat_two">
                      <option value="">Select</option>
                      @foreach ($categories as $category)
                      <option {{$category->id == $popular_category_section[1]->category ? 'selected' : ''}} value="{{ $category->id}}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" >
                    <label for="inputState">Sub Category</label>
                    <select id="inputState" class="form-control sub-category" name="sub_cat_two">
                      <option value="">Select</option>
                      @foreach ($subCategories as $subCategory)
                      <option {{$subCategory->id == $popular_category_section[1]->sub_category ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" >
                    @php
                        $childCategories= \App\Models\ChildCategory::where('sub_category_id',$popular_category_section[1]->sub_category)->get();
                    @endphp
                    <label for="inputState">Child Category</label>
                    <select id="inputState" class="form-control child-category" name="child_cat_two">
                      <option value="">Select</option>
                      @foreach ($childCategories as $childCategory)
                      <option {{$childCategory->id == $popular_category_section[1]->child_category ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                      @endforeach
                    </select>
                </div>
            </div>
        </div>
        <h5>Category 3</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group" >
                    <label for="inputState">Category</label>
                    <select id="inputState" class="form-control main-category" name="cat_three">
                      <option value="">Select</option>
                      @foreach ($categories as $category)
                      <option {{$category->id == $popular_category_section[2]->category ? 'selected' : ''}} value="{{ $category->id}}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" >
                    @php
                        $subCategories= \App\Models\SubCategory::where('category_id',$popular_category_section[2]->category)->get();
                    @endphp
                    <label for="inputState">Sub Category</label>
                    <select id="inputState" class="form-control sub-category" name="sub_cat_three">
                      <option value="">Select</option>
                      @foreach ($subCategories as $subCategory)
                      <option {{$subCategory->id == $popular_category_section[2]->sub_category ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" >
                    @php
                        $childCategories= \App\Models\ChildCategory::where('sub_category_id',$popular_category_section[2]->sub_category)->get();
                    @endphp
                    <label for="inputState">Child Category</label>
                    <select id="inputState" class="form-control child-category" name="child_cat_three">
                      <option value="">Select</option>
                      @foreach ($childCategories as $childCategory)
                      <option {{$childCategory->id == $popular_category_section[2]->child_category ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                      @endforeach
                    </select>
                </div>
            </div>
        </div>
        <h5>Category 4</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group" >
                    @php
                        $subCategories= \App\Models\SubCategory::where('category_id',$popular_category_section[3]->category)->get();
                    @endphp
                    <label for="inputState">Category</label>
                    <select id="inputState" class="form-control main-category" name="cat_four">
                      <option value="">Select</option>
                      @foreach ($categories as $category)
                      <option {{$category->id == $popular_category_section[3]->category ? 'selected' : ''}} value="{{ $category->id}}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" >
                    <label for="inputState">Sub Category</label>
                    <select id="inputState" class="form-control sub-category" name="sub_cat_four">
                      <option value="">Select</option>
                      @foreach ($subCategories as $subCategory)
                      <option {{$subCategory->id == $popular_category_section[3]->sub_category ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" >
                    @php
                        $childCategories= \App\Models\ChildCategory::where('sub_category_id',$popular_category_section[3]->sub_category)->get();
                    @endphp
                    <label for="inputState">Child Category</label>
                    <select id="inputState" class="form-control child-category" name="child_cat_four">
                      <option value="">Select</option>
                      @foreach ($childCategories as $childCategory)
                      <option {{$childCategory->id == $popular_category_section[3]->child_category ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                      @endforeach
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@push('scripts')
    <script>
        $(document).ready(function(){
            //get sub category
            $('body').on('change','.main-category', function(e){
                let id=$(this).val();
                let row=$(this).closest('.row');
                $.ajax({
                    url: "{{route('admin.get-subCategories')}}",
                    method: 'GET',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        let select=row.find('.sub-category');
                        select.html('<option value="">Select Sub Category</option>');
                        $.each(data, function(i, item){
                            select.append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.error('Error status:', status);
                        console.error('Error message:', error);
                        console.error('XHR object:', xhr);
                    }
                });
            })

            /** get child categories */

            $('body').on('change','.sub-category', function(e){
                let id=$(this).val();
                let row=$(this).closest('.row');
                $.ajax({
                    url: "{{route('admin.product.get-child-categories')}}",
                    method: 'GET',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        let select=row.find('.child-category');
                        select.html('<option value="">Select child Category</option>');
                        $.each(data, function(i, item){
                            select.append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.error('Error status:', status);
                        console.error('Error message:', error);
                        console.error('XHR object:', xhr);
                    }
                });
            })
        })
    </script>
@endpush
