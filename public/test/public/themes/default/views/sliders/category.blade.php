    <!-- Categories Section Begin -->
    <div class="section-title">
        <h2>&nbsp;&nbsp;&nbsp;&nbsp;</h2>
    </div>

    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach($categories as $item)
                    <div class="col-lg-3" style = "width:100% !important; cursor:pointer !important;" onclick="location.href='{{ route('category.browse', $item->slug) }}';">
                        <div class="categories__item set-bg" data-setbg="{{ get_cover_img_src($item, 'category') }}" style = "width:100% !important">
                            <h5><a href="{{ route('category.browse', $item->slug) }}">{{ $item->name }}</a></h5>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    
    <div class="section-title">
        <h2>&nbsp;&nbsp;&nbsp;&nbsp;</h2>
    </div>
    <!-- Categories Section End -->