<div class="carousel-item active banner-dummy" style="background-color: {{ $slide->bg_color }}">
    <div class="view mx-lg-auto">
        <div class="col-xs">
            <img class="mr-lg-5 mr-xl-0" src="{{ asset('images/slides/'.$slide->slide) }}">
        </div>
        <div class="col carousel-caption px-3 pt-4 pb-0 py-sm-4 pl-sm-4 pl-md-5 ml-lg-4 pl-xl-0 ml-xl-0 text-left smooth-scroll">
{{--            <h1 class="h3-responsive mar-content"><a href="#!"><span>12.ру - код твоей новой связи</span></a></h1>--}}
            <h1 class="h3-responsive mar-content" style="color: {{ $slide->text_color }}">{{ $slide->title }}</h1>
            @if ($slide->subscribe)
                <p class="mar-content">{{ $slide->subscribe }}</p>
            @endif
        </div>
    </div>
</div>
