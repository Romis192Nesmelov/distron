@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks._title_block')
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_metric') }}" method="post">
                @csrf
                @include('admin.blocks._hidden_id_block',['field' => 'metric'])
                    @include('admin.blocks._input_block', [
                        'label' => trans('admin.metric_name'),
                        'name' => 'name',
                        'type' => 'text',
                        'max' => 255,
                        'placeholder' => trans('admin.metric_name'),
                        'value' => isset($data['metric']) ? $data['metric']->name : ''
                    ])
                    @include('admin.blocks._textarea_block',[
                        'label' => trans('admin.metric_code'),
                        'name' => 'code',
                        'simple' => true,
                        'value' => isset($data['metric']) ? $data['metric']->code : ''
                    ])
                    @include('admin.blocks._checkbox_block',[
                        'name' => 'active',
                        'label' => trans('admin.metric_is_active'),
                        'checked' => isset($data['metric']) ? $data['metric']->active : true
                    ])
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
@endsection
