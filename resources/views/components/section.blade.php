{{--<a name="{{ $attributes->get('data-scroll-destination') }}"></a>--}}
<div {{ $attributes->class('section') }}>
    <div class="container pad-block pb-0 {{ $attributes->has('wow_delay') ? 'wow animate__animated animate__fadeIn' : '' }}" {{ $attributes->has('wow_delay') ? 'data-wow-delay='.$attributes->get('wow_delay').'s' : '' }}>
        @if ($attributes->has('head'))
            <h2>{{ $attributes->get('head') }}</h2>
        @endif
        {{ $slot }}
    </div>
</div>
