@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks._title_block')
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_contact') }}" method="post">
                @csrf
                @include('admin.blocks._hidden_id_block',['field' => 'contact'])
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="panel panel-flat">
                            <x-atitle>{{ trans('admin.contact_type') }}</x-atitle>
                            <div class="panel-body">
                                @include('admin.blocks._radio_button_block',[
                                    'values' => [
                                            ['val' => 1, 'descript' => trans('content.address')],
                                            ['val' => 2, 'descript' => trans('content.phone')],
                                            ['val' => 3, 'descript' => 'E-mail'],
                                            ['val' => 4, 'descript' => trans('admin.map')],
                                        ],
                                    'name' => 'type',
                                    'activeValue' => isset($data['contact']) ? $data['contact']->type : 1
                                ])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                @include('admin.blocks._input_block', [
                                    'label' => trans('admin.contact'),
                                    'name' => 'contact',
                                    'type' => 'text',
                                    'max' => 255,
                                    'placeholder' => trans('admin.contact'),
                                    'value' => isset($data['contact']) ? $data['contact']->contact : ''
                                ])
                            </div>
                        </div>
                    </div>
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
@endsection
