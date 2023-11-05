@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.content') }}</x-atitle>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_content') }}" method="post">
                @csrf
                @include('admin.blocks._hidden_id_block',['field' => 'content'])
                <div class="col-lg-{{ count($data['content']->images) > 1 ? '12' : '3' }} col-md-6 col-xs-12">
                    @foreach ($data['content']->images as $k => $image)
                        <div class="col-lg-{{ round(12/count($data['content']->images)) }} col-md-6 col-xs-12">
                            @include('admin.blocks._input_image_block',[
                                'head' => trans('admin.preview'),
                                'name' => 'preview'.$k,
                                'preview' => asset($image->preview),
                                'full' => asset($image->preview)
                            ])
                            @if ($data['content']->id == 2)
                                @include('admin.blocks._input_image_block',[
                                    'head' => trans('admin.full'),
                                    'name' => 'full'.$k,
                                    'preview' => asset($image->full),
                                    'full' => asset($image->full)
                                ])
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-{{ count($data['content']->images) > 1 ? '12' : '9' }} col-md-6 col-xs-12">
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
