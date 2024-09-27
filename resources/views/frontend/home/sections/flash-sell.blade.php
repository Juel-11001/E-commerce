<section id="wsus__flash_sell" class="wsus__flash_sell_2">
    <div class=" container">
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time" style="background: url({{asset('frontend/images/flash_sell_bg.jpg')}})">
                    <div class="wsus__flash_coundown">
                        <span class=" end_text">flash sale</span>
                        <div class="simply-countdown simply-countdown-one"></div>
                        <a class="common_btn" href="{{route('flash-sale')}}">see more <i class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">

             @php
                 $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')->with(['category', 'variants', 'productImageGalleries'])->whereIn('id', $flashSaleItems)->get();
             @endphp
             @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach

        </div>
    </div>
</section>


@push('scripts')
    <script>
       $(document).ready(function() {
    //     var d = new Date(),
    //     countUpDate = new Date();
    // d.setDate(d.getDate() + 90);
        simplyCountdown('.simply-countdown-one', {
        year: {{date('Y', strtotime($flashSaleDate->end_date))}},
        month:{{date('m', strtotime($flashSaleDate->end_date))}},
        day: {{date('d', strtotime($flashSaleDate->end_date))}},
        // enableUtc: true
    });
       })
    </script>
@endpush
