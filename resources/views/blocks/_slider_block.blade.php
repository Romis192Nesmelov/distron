<div class="slider col-md-{{ $colMd }} col-sm-12 col-xs-12">
    <h3>{{ $sliderHead }}</h3>
    <div class="noui-slider-info has-pips" id="{{ $slideId }}"></div>
</div>

<input type="hidden" name="{{ $sliderName }}_from" value="{{ $sliderFrom }}">
@if (isset($sliderTo))
    <input type="hidden" name="{{ $sliderName }}_to" value="{{ $sliderTo }}">
@endif

<script>
    $('#{{ $slideId }}').ionRangeSlider({
        {!! isset($type) && $type ? 'type: "'.$type.'",' : '' !!}
        grid: true,
        min: {{ $sliderMin }},
        max: {{ $sliderMax }},
        from: {{ $sliderFrom }},
        {!! isset($sliderTo) ? 'to: '.$sliderTo.',' : '' !!}
        step: {{ $sliderStep }},
        prettify_enabled: false,
        onFinish: function (data) {
            $('input[name={{ $sliderName }}_from]').val(data.from).trigger('change', [data]);
            @if (isset($sliderTo))
                $('input[name={{ $sliderName }}_to]').val(data.to).trigger('change', [data]);
            @endif
        }
    });
</script>
