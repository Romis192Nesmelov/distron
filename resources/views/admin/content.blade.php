@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.content') }}</x-atitle>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_content') }}" method="post">
                @csrf
                @include('admin.blocks._hidden_id_block',['field' => 'content'])
                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('admin.blocks._textarea_block',[
                        'label' => trans('content.in_russian'),
                        'name' => 'content_ru',
                        'value' => $data['content']->content_ru
                    ])
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('admin.blocks._textarea_block',[
                        'label' => trans('content.in_english'),
                        'name' => 'content_en',
                        'value' => $data['content']->content_en
                    ])
                </div>
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
@endsection
