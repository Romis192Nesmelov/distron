@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks._title_block')
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_accumulator') }}" method="post">
                @csrf
                @include('admin.blocks._hidden_id_block',['field' => 'accumulator'])
                <div class="panel panel-flat">
                    <div class="panel-body">
                        @include('admin.blocks._input_block', [
                            'label' => trans('content.accumulator_type'),
                            'name' => 'name',
                            'type' => 'text',
                            'max' => 255,
                            'placeholder' => trans('admin.accumulator_type'),
                            'value' => isset($data['accumulator']) ? $data['accumulator']->name : ''
                        ])
                        @include('admin.blocks._checkbox_block',[
                            'name' => 'active',
                            'label' => trans('admin.accumulator_active'),
                            'checked' => isset($data['accumulator']) ? $data['accumulator']->active : true
                        ])
                    </div>
                </div>
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
@endsection
