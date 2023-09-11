@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks._title_block')
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_icon') }}" method="post">
                @csrf
                @include('admin.blocks._hidden_id_block',['field' => 'icon'])
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="col-md-2 col-sm-3 col-xs-12">
                            @include('admin.blocks._input_image_block',[
                                'name' => 'image',
                                'preview' => isset($data['icon']) ? asset('images/icons/icon'.$data['icon']->id.'.svg') : ''
                            ])
                        </div>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                            @include('admin.blocks._input_block', [
                                'label' => trans('admin.head_icon'),
                                'name' => 'title',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('admin.head_icon'),
                                'value' => isset($data['icon']) ? $data['icon']->title : ''
                            ])
                            @include('admin.blocks._checkbox_block',[
                                'name' => 'active',
                                'label' => trans('admin.icon_is_active'),
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
