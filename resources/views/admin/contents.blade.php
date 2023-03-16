@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.content') }}</x-atitle>
        <div class="panel-body">
            <table class="table table-striped table-items">
                <tr>
                    <th class="text-center">{{ trans('content.content_type') }}</th>
                    <th class="text-center">{{ trans('admin_menu.content') }}</th>
                    @include('admin.blocks._th_edit_cell_block')
                </tr>
                @foreach ($data['contents'] as $k => $content)
                    <tr role="row" id="{{ 'content_'.$content->id }}">
                        <td class="text-center head"><b>{{ isset($data['heads'][$k]) ? $data['heads'][$k] : '' }}</b></td>
                        <td class="text-left">{{ $content['content_'.app()->getLocale()] }}</td>
                        @include('admin.blocks._edit_cell_block', ['href' => route($menu[$data['menu_key']]['href'], ['id' => $content->id])])
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
