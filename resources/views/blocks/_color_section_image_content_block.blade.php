<div class="col-12 col-lg-4 row photos-block">
    @foreach ($images as $k => $image)
        <div class="image d-flex align-items-{{ $k <= 1 ? 'end' : 'start' }} col-lg-6 col-md-6 p-1">
            <a href="{{ asset($image->full) }}" class="fancybox">
                <img class="border border-2 border-light" src="{{ asset($image->preview) }}" alt="{{ $head }}" />
            </a>
        </div>
    @endforeach
</div>
<div class="col-12 col-lg-8">
    <h2>{{ $head }}</h2>
    {!! $text !!}
</div>
