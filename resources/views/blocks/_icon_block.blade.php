<div class="icon text-center mb-3 col-lg-{{ $col }} col-md-6 col-sm-6 col-xs-12 wow animate__animated animate__fadeIn" data-wow-delay=".{{ $delay }}s">
    <img src="{{ asset('images/icons/icon'.$icon->id.'.svg') }}" alt="{{ $icon->title }}">
    <h6 class="mt-2 text-center">{{ $icon->title }}</h6>
    @if (isset($icon->description) && $icon->description)
        <p class="text-center">{{ $icon->description }}</p>
    @endif
</div>
