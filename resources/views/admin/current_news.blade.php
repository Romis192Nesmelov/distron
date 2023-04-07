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
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            @include('admin.blocks._input_image_block',[
                                'preview' => isset($data['news']) ? asset('images/news/news'.$data['news']->id.'.jpg') : '',
                                'full' => isset($data['news']) ? asset('images/news/news'.$data['news']->id.'.jpg') : ''
                            ])
                        </div>
                        <div class="col-md-9 col-sm-6 col-xs-12">
                            @include('admin.blocks._input_date_block',[
                                'label' => trans('admin.news_date'),
                                'name' => 'time',
                                'value' => isset($data['news']) ? $data['news']->time : time()
                            ])
                            @include('admin.blocks._input_block', [
                                'required' => true,
                                'label' => trans('admin.head_news'),
                                'name' => 'head',
                                'type' => 'text',
                                'placeholder' => trans('admin.head_news'),
                                'value' => isset($data['news']) ? $data['news']->head : ''
                            ])
                            @include('admin.blocks._textarea_block',[
                                'required' => true,
                                'name' => 'text',
                                'label' => trans('admin.news_content'),
                                'value' => isset($data['news']) ? $data['news']->text : ''
                            ])
                        </div>
                        @include('admin.blocks._checkbox_block',[
                            'name' => 'active',
                            'label' => trans('admin.news_is_active'),
                            'checked' => isset($data['news']) ? $data['news']->active : true
                        ])
                    </div>
                </div>
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
@endsection
