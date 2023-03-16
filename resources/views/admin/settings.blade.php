@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks._title_block')
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_settings') }}" method="post">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <x-atitle val="4">{{ trans('content.seo') }}</x-atitle>
                        @include('admin.blocks._input_block', [
                            'label' => trans('content.page_title').trans('content.in_russian'),
                            'name' => 'title_ru',
                            'type' => 'text',
                            'placeholder' => trans('content.page_title').trans('content.in_russian'),
                            'value' => $data['settings']['title_ru']
                        ])
                        @include('admin.blocks._input_block', [
                            'label' => trans('content.page_title').trans('content.in_english'),
                            'name' => 'title_en',
                            'type' => 'text',
                            'placeholder' => trans('content.page_title').trans('content.in_english'),
                            'value' => $data['settings']['title_en']
                        ])
                        @foreach($data['metas'] as $meta => $params)
                            @include('admin.blocks._input_block', [
                                'label' => $params['name'] ? $params['name'] : $params['property'],
                                'name' => $meta,
                                'type' => 'text',
                                'placeholder' => $params['name'] ? $params['name'] : $params['property'],
                                'value' => $data['settings'][$meta]
                            ])
                        @endforeach
                    </div>
                </div>
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
@endsection
