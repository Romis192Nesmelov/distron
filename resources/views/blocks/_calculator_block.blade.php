<div class="col-md-4 col-sm-12 col-xs-12">
    <h3 class="text-semibold">Тип аккумулятора</h3>
    @include('blocks._select_block',[
        'values' => $accumulators,
        'name' => 'accumulator',
        'selected' => 1
    ])
</div>

@foreach($params as $param)
    @include('blocks._slider_block',[
        'colMd' => 4,
        'sliderHead' => $param->type ? trans('content.resistance') : trans('content.voltage'),
        'sliderName' => $param->type ? 'resistance' : 'voltage',
        'slideId' => $param->type ? 'slider-resistance' : 'slider-voltage',
        'sliderMin' => $param->min,
        'sliderMax' => $param->max,
        'sliderFrom' => $param->max*0.7,
        'sliderStep' => 1
    ])
@endforeach

<div class="col-12 mt-4" id="calc-result">
    <h3 class="text-semibold">{{ trans('content.value') }}</h3>
    <h2><spam>5000</spam>₽</h2>
</div>
