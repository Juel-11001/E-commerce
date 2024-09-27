@php
    $categoryProductSliderSectionThree=json_decode($categoryProductSliderSectionThree->value);
    // dd($categoryProductSliderSectionThree);
@endphp
<section id="wsus__weekly_best" class="home2_wsus__weekly_best_2 ">
    <div class="container">
        <div class="row">
            @foreach ($categoryProductSliderSectionThree as $sliderSectionThree)
            @php
            $lastKey=[];
                foreach ($sliderSectionThree as $key => $category) {
                    if ($category === null) {
                        break;
                    }$lastKey = [$key=>$category];
                }
                // dd($lastKey);
                if (array_keys($lastKey)[0] === 'category') {
                    //category
                    $category=\App\Models\Category::find($lastKey['category']);
                    $products = \App\Models\Product::withAvg('reviews', 'rating')->withCoutn('reviews')->where('category_id', $category->id)->orderBy('id', 'desc')->take(6)->get();
                }elseif (array_keys($lastKey)[0] === 'sub_category') {
                    //sub category
                    $category=\App\Models\SubCategory::find($lastKey['sub_category']);
                    $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')->where('sub_category_id', $category->id)->orderBy('id', 'desc')->take(6)->get();
                }else {
                    //child category
                    $category=\App\Models\ChildCategory::find($lastKey['child_category']);
                    $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')->where('child_category_id', $category->id)->orderBy('id', 'desc')->take(6)->get();
                }
                // dd($category);
            @endphp
            <div class="col-xl-6 col-sm-6">
                <div class="wsus__section_header">
                    <h3>{{$category->name}}</h3>
                </div>
                <div class="row weekly_best2">
                    @foreach ($products as $product)
                    <div class="col-xl-4 col-lg-4">
                        <a class="wsus__hot_deals__single" href="{{route('product-detail', $product->slug)}}">
                            <div class="wsus__hot_deals__single_img">
                                <img src="{{$product->thumb_image}}" alt="{{$product->name}}" class="img-fluid w-100">
                            </div>
                            <div class="wsus__hot_deals__single_text mt-2">
                                <h5>{!!limitText($product->name, 14)!!}</h5>
                                <p class="wsus__rating">

                           @for ($i=1; $i <= 5; $i++)
                            @if ($i<=$product->reviews_avg_rating)
                            <i class="fas fa-star"></i>
                            @else
                            <i class="far fa-star"></i>
                            @endif
                           @endfor
                                    {{-- <span>({{$product->reviews_count}} review)</span> --}}
                                </p>
                                @if (checkDiscount($product))

                                    <p class="wsus__tk">{{$settings->currency_icon}}{{$product->offer_price}} <del>{{$settings->currency_icon}}{{$product->price}}</del></p>
                                    @else
                                    <p class="wsus__tk">{{$settings->currency_icon}}{{$product->price}}</p>
                                    @endif
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
