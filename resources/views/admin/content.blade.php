@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.content') }}</x-atitle>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_content') }}" method="post">
                @csrf
                @include('admin.blocks._hidden_id_block',['field' => 'content'])
                <div class="col-md-4 col-sm-6 col-xs-12">
                    @include('admin.blocks._input_image_block',[
                        'name' => 'image',
                        'preview' => asset('images/contents/'.$data['content']->image)
                    ])
                </div>
                <div class="col-md-8 col-sm-62 col-xs-12">
                    @include('admin.blocks._input_block', [
                        'label' => trans('admin.head'),
                        'name' => 'head',
                        'type' => 'text',
                        'max' => 255,
                        'placeholder' => trans('admin.head'),
                        'value' => $data['content']->head
                    ])
                    @include('admin.blocks._textarea_block',[
                        'label' => trans('admin_menu.content'),
                        'name' => 'text',
                        'value' => $data['content']->text
                    ])
                </div>
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
@endsection
