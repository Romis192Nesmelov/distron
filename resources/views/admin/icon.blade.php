@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks._title_block')
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_why_us') }}" method="post">
                @csrf
                @include('admin.blocks._hidden_id_block',['field' => 'icon'])
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            @include('admin.blocks._input_image_block',[
                                'name' => 'image',
                                'preview' => isset($data['icon']) ? asset($data['icon']->image) : ''
                            ])
                        </div>
                        <div class="col-md-9 col-sm-6 col-xs-12">
                            @include('admin.blocks._input_block', [
                                'label' => trans('content.head_icon').trans('content.in_russian'),
                                'name' => 'title_ru',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('content.head_icon').trans('content.in_russian'),
                                'value' => isset($data['icon']) ? $data['icon']->title_ru : ''
                            ])

                            @include('admin.blocks._input_block', [
                                'label' => trans('content.head_icon').trans('content.in_english'),
                                'name' => 'title_en',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('content.head_icon').trans('content.in_english'),
                                'value' => isset($data['icon']) ? $data['icon']->title_en : ''
                            ])

                            @if (isset($data['use_description']) && $data['use_description'])
                                @include('admin.blocks._textarea_block',[
                                    'simple' => true,
                                    'name' => 'description_ru',
                                    'value' => isset($data['icon']) ? $data['icon']->description_ru : ''
                                ])

                                @include('admin.blocks._textarea_block',[
                                    'simple' => true,
                                    'name' => 'description_ru',
                                    'value' => isset($data['icon']) ? $data['icon']->description_en : ''
                                ])
                            @endif
                            @include('admin.blocks._checkbox_block',[
                                'name' => 'military',
                                'label' => trans('content.military_icon'),
                                'checked' => isset($data['icon']) ? $data['icon']->military : false
                            ])
                            @include('admin.blocks._checkbox_block',[
                                'name' => 'active',
                                'label' => trans('content.icon_is_active'),
                                'checked' => isset($data['icon']) ? $data['icon']->active : true
                            ])
                        </div>
                    </div>
                </div>
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
@endsection
