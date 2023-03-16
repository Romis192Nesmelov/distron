@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks._title_block')
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_news') }}" method="post">
                @csrf
                @include('admin.blocks._hidden_id_block',['field' => 'news'])
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            @include('admin.blocks._input_image_block',[
                                'preview' => isset($data['news']) ? asset($data['news']->image) : '',
                                'full' => isset($data['news']) ? asset($data['news']->image) : ''
                            ])
                        </div>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            @include('admin.blocks._input_date_block',[
                                'label' => trans('content.date_news'),
                                'name' => 'time',
                                'value' => isset($data['news']) ? $data['news']->time : time()
                            ])
                            @include('admin.blocks._input_block', [
                                'required' => true,
                                'label' => trans('content.title_news').trans('content.in_russian'),
                                'name' => 'title_ru',
                                'type' => 'text',
                                'placeholder' => trans('content.title_news').trans('content.in_russian'),
                                'value' => isset($data['news']) ? $data['news']->title_ru : ''
                            ])
                            @include('admin.blocks._input_block', [
                                'required' => true,
                                'label' => trans('content.title_news').trans('content.in_english'),
                                'name' => 'title_en',
                                'type' => 'text',
                                'placeholder' => trans('content.title_news').trans('content.in_english'),
                                'value' => isset($data['news']) ? $data['news']->title_en : ''
                            ])
                        </div>
                    </div>
                </div>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            @include('admin.blocks._textarea_block',[
                                'simple' => true,
                                'name' => 'content_ru',
                                'label' => trans('content.content_news').trans('content.in_russian'),
                                'value' => isset($data['news']) ? $data['news']->content_ru : ''
                            ])
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            @include('admin.blocks._textarea_block',[
                                'simple' => true,
                                'name' => 'content_en',
                                'label' => trans('content.content_news').trans('content.in_english'),
                                'value' => isset($data['news']) ? $data['news']->content_en : ''
                            ])
                        </div>
                        @include('admin.blocks._checkbox_block',[
                            'name' => 'active',
                            'label' => trans('content.news_is_active'),
                            'checked' => isset($data['news']) ? $data['news']->active : true
                        ])
                    </div>
                </div>
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
@endsection
