@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks._title_block')
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_video') }}" method="post">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="video">
                            @if (isset($data['video']))
                                <video controls="controls" poster="{{ asset('images/distron.jpg') }}">
                                    <source src="{{ asset($data['video']->path) }}" type='video/{{ pathinfo($data['video']->path)['extension'] }};'>
                                </video>
                            @endif
                            @include('admin.blocks._input_file_block', ['label' => '', 'name' =>  'video'])
                        </div>
                    </div>
                </div>
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
@endsection
