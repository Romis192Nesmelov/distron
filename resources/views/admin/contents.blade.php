@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.content') }}</x-atitle>
        <div class="panel-body">
            <table class="table table-striped table-items">
                <tr>
                    <th class="text-center">{{ trans('admin.image') }}</th>
                    <th class="text-center">{{ trans('admin.head') }}</th>
                    <th class="text-center">{{ trans('admin_menu.content') }}</th>
                    @include('admin.blocks._th_edit_cell_block')
                </tr>
                @foreach ($data['contents'] as $k => $content)
                    <tr role="row" id="{{ 'content_'.$content->id }}">
                        <td class="image">
                            @foreach ($content->images as $image)
                                <div class="col-12 {{ count($content->images) > 1 ? 'col-lg-6' : '' }}">
                                    <a class="img-preview" href="{{ asset($image->full ? $image->full : $image->preview) }}">
                                        <img src="{{ asset($image->preview) }}" />
                                    </a>
                                </div>
                            @endforeach
                        </td>
                        <td class="text-center head"><b>{{ $content->head }}</b></td>
                        <td class="text-left">{{ $content->text }}</td>
                        @include('admin.blocks._edit_cell_block', ['href' => route($menu[$data['menu_key']]['href'], ['id' => $content->id])])
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
