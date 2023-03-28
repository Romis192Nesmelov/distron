<div class="col-md-{{ $imageCol }} col-sm-12 col-xs-12 mb-3 image">
    <img src="{{ $image }}" alt="{{ $head }}" />
</div>
<div class="col-md-{{ 12-$imageCol }} col-sm-12 col-xs-12">
    <h2>{{ $head }}</h2>
    {!! $text !!}
</div>
