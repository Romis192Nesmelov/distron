@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin.edit_calculator') }}</x-atitle>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_calculator') }}" method="post">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-body">
                        @foreach($data['params'] as $param)
                            @include('blocks._slider_block',[
                                'colMd' => 6,
                                'type' => 'double',
                                'sliderHead' => $param->type ? trans('content.resistance') : trans('content.voltage'),
                                'slideId' => $param->type ? 'slider-resistance' : 'slider-voltage',
                                'sliderName' => $param->type ? 'resistance' : 'voltage',
                                'sliderMin' => 0,
                                'sliderMax' => 50,
                                'sliderFrom' => $param->min,
                                'sliderTo' => $param->max,
                                'sliderStep' => 1
                            ])
                        @endforeach
                    </div>
                </div>
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
@endsection
