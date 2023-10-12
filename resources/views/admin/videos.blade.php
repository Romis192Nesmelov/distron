@extends('layouts.admin')

@section('content')
    @include('admin.blocks._modal_delete_block',[
        'modalId' => 'delete-modal',
        'action' => 'delete_icon',
        'head' => trans('admin.do_you_really_want_delete_this_video')
    ])
    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin.video_poster') }}</x-atitle>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_video_poster') }}" method="post">
                @csrf
                <div class="col-md-6 col-sm-12">
                    @include('admin.blocks._input_image_block',[
                        'name' => 'poster',
                        'preview' => asset('images/distron.jpg')
                    ])
                </div>
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin.video_href') }}</x-atitle>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_video_href') }}" method="post">
                @csrf
                @include('admin.blocks._input_block', [
                    'label' => trans('admin.video_href'),
                    'name' => 'href',
                    'type' => 'text',
                    'max' => 255,
                    'placeholder' => trans('admin.video_href'),
                    'value' => $data['video_href']
                ])
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>

    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.video') }}</x-atitle>
        <div class="panel-body">
            <table class="table table-striped table-items">
                <tr>
                    <th class="text-center">{{ trans('admin_menu.video') }}</th>
                    @include('admin.blocks._th_edit_cell_block')
                    @include('admin.blocks._th_delete_cell_block')
                </tr>

                @foreach ($data['videos'] as $video)
                    <tr role="row" id="{{ 'video_'.$video->id }}">
                        <td class="video">
                            <video controls="controls" poster="{{ asset('images/distron.jpg') }}">
                                <source src="{{ asset($video->path) }}" type='video/{{ pathinfo($video->path)['extension'] }};'>
                            </video>
                        </td>
                        @include('admin.blocks._edit_cell_block', ['href' => route($menu[$data['menu_key']]['href'], ['id' => $video->id])])
                        @include('admin.blocks._delete_cell_block',['id' => $video->id])
                    </tr>
                @endforeach
            </table>
            @include('admin.blocks._add_button_block',[
                'href' => route($menu[$data['menu_key']]['href']).'/add',
                'text' => trans('admin.add_video')
            ])
        </div>
    </div>
@endsection
