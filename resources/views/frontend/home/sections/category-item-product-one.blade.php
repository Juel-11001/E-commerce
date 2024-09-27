@php
    $categoryProductSliderSectionOne=json_decode($categoryProductSliderSectionOne->value);
    $lastKey=[];
    foreach ($categoryProductSliderSectionOne as $key => $category) {
        if ($category === null) {
            break;
        }$lastKey = [$key=>$category];
    }
    // dd($lastKey);
    // dd(array_keys($lastKey)[0]);
    if (array_keys($lastKey)[0] === 'category') {
        //category
        $category=\App\Models\Category::find($lastKey['category']);
        $products= \App\Models\Product::withAvg('reviews', 'rating')->with(['category', 'variants', 'productImageGalleries'])->withCount('reviews')->where('category_id', $category->id)->orderBy('id', 'desc')->take(12)->get();
    }elseif (array_keys($lastKey)[0] === 'sub_category') {
        //sub category
        $category=\App\Models\SubCategory::find($lastKey['sub_category']);
        $products= \App\Models\Product::withAvg('reviews', 'rating')->with(['category', 'variants', 'productImageGalleries'])->withCount('reviews')->where('sub_category_id', $category->id)->orderBy('id', 'desc')->take(12)->get();
    }else {
        //child category
        $category=\App\Models\ChildCategory::find($lastKey['child_category']);
        $products= \App\Models\Product::withAvg('reviews', 'rating')->with(['category', 'variants', 'productImageGalleries'])->withCount('reviews')->where('child_category_id', $category->id)->orderBy('id', 'desc')->take(12)->get();
    }
@endphp
<section id="wsus__electronic">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>{{$category->name}}</h3>
                    <a class="see_btn" href="{{route('products.inex', ['category' => $category->slug])}}">see more <i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
          @foreach ($products as $product)
            <x-product-card :product="$product" />
          @endforeach
        </div>
    </div>
</section>
