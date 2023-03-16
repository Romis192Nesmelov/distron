@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks._title_block')
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_projects_type') }}" method="post">
                @csrf
                @include('admin.blocks._hidden_id_block',['field' => 'projects_type'])
                <div class="panel panel-flat">
                    <div class="panel-body">
                        @if ($data['projects_type']->id != 1)
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                @include('admin.blocks._input_image_block',[
                                    'preview' => isset($data['projects_type']) ? asset($data['projects_type']->image) : '',
                                    'full' => isset($data['projects_type']) ? asset($data['projects_type']->image) : ''
                                ])
                            </div>
                        @endif
                        <div class="col-md-{{ $data['projects_type']->id != 1 ? '8' : '12' }} col-sm-{{ $data['projects_type']->id != 1 ? '6' : '12' }} col-xs-12">
                            @include('admin.blocks._input_block', [
                                'required' => true,
                                'label' => trans('content.projects_type_name').trans('content.in_russian'),
                                'name' => 'name_ru',
                                'type' => 'text',
                                'placeholder' => trans('content.projects_type_name').trans('content.in_russian'),
                                'value' => isset($data['projects_type']) ? $data['projects_type']->name_ru : ''
                            ])
                            @include('admin.blocks._input_block', [
                                'required' => true,
                                'label' => trans('content.projects_type_name').trans('content.in_english'),
                                'name' => 'name_en',
                                'type' => 'text',
                                'placeholder' => trans('content.projects_type_name').trans('content.in_english'),
                                'value' => isset($data['projects_type']) ? $data['projects_type']->name_en : ''
                            ])
                        </div>
                    </div>
                </div>
                @if ($data['projects_type']->id != 1)
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                @include('admin.blocks._textarea_block',[
                                    'simple' => true,
                                    'name' => 'description_ru',
                                    'label' => trans('content.projects_type_description').trans('content.in_russian'),
                                    'value' => isset($data['projects_type']) ? $data['projects_type']->description_ru : ''
                                ])
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                @include('admin.blocks._textarea_block',[
                                    'simple' => true,
                                    'name' => 'description_en',
                                    'label' => trans('content.projects_type_description').trans('content.in_english'),
                                    'value' => isset($data['projects_type']) ? $data['projects_type']->description_en : ''
                                ])
                            </div>
                            @include('admin.blocks._checkbox_block',[
                                'name' => 'active',
                                'label' => trans('content.projects_type_is_active'),
                                'checked' => isset($data['projects_type']) ? $data['projects_type']->active : true
                            ])
                        </div>
                    </div>
                @endif
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
@endsection
