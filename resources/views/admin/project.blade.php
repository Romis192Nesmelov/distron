@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks._title_block')
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_project') }}" method="post">
                @csrf
                @include('admin.blocks._hidden_id_block',['field' => 'project'])
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <x-atitle>{{ trans('content.projects_type') }}</x-atitle>
                        @include('admin.blocks._select_block',[
                            'values' => $data['types'],
                            'name' => 'project_type_id',
                            'selected' => isset($data['project']) ? $data['project']->project_type_id : ''
                        ])
                    </div>
                </div>

                <div class="panel panel-flat">
                    <div class="panel-body">
                        @for ($i=0;$i<5;$i++)
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                @foreach(['preview','full'] as $suffix)
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        @include('admin.blocks._input_image_block',[
                                            'name' => 'image_'.$suffix.($i+1),
                                            'preview' => isset($data['project']) ? asset($data['project']->images[$i][$suffix]) : '',
                                            'full' => isset($data['project']) ? asset($data['project']->images[$i][$suffix]) : ''
                                        ])
                                    </div>
                                @endforeach
                            </div>
                        @endfor
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            @include('admin.blocks._input_block', [
                                'required' => true,
                                'label' => trans('content.project_name').trans('content.in_russian'),
                                'name' => 'name_ru',
                                'type' => 'text',
                                'placeholder' => trans('content.project_name').trans('content.in_russian'),
                                'value' => isset($data['project']) ? $data['project']->name_ru : ''
                            ])
                            @include('admin.blocks._input_block', [
                                'required' => true,
                                'label' => trans('content.project_name').trans('content.in_english'),
                                'name' => 'name_en',
                                'type' => 'text',
                                'placeholder' => trans('content.project_name').trans('content.in_english'),
                                'value' => isset($data['project']) ? $data['project']->name_en : ''
                            ])
                        </div>
                    </div>
                </div>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            @include('admin.blocks._textarea_block',[
                                'simple' => true,
                                'name' => 'description_ru',
                                'label' => trans('content.project_description').trans('content.in_russian'),
                                'value' => isset($data['project']) ? $data['project']->description_ru : ''
                            ])
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            @include('admin.blocks._textarea_block',[
                                'simple' => true,
                                'name' => 'description_en',
                                'label' => trans('content.project_description').trans('content.in_english'),
                                'value' => isset($data['project']) ? $data['project']->description_en : ''
                            ])
                        </div>
                        @include('admin.blocks._checkbox_block',[
                            'name' => 'active',
                            'label' => trans('content.project_is_active'),
                            'checked' => isset($data['project']) ? $data['project']->active : true
                        ])
                    </div>
                </div>
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
@endsection
