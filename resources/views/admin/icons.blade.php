@extends('layouts.admin')

@section('content')
    @include('admin.blocks._modal_delete_block',[
        'modalId' => 'delete-modal',
        'action' => 'delete_icon',
        'head' => trans('admin.do_you_really_want_delete_this_icon')
    ])

    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.icons') }}</x-atitle>
        <div class="panel-body">
            <table class="table table-striped table-items">
                <tr>
                    <th class="text-center">{{ trans('admin.icon') }}</th>
                    <th class="text-center">{{ trans('admin.head_icon') }}</th>
                    <th class="text-center">{{ trans('admin.icon_status') }}</th>
                    @include('admin.blocks._th_edit_cell_block')
                    @include('admin.blocks._th_delete_cell_block')
                </tr>

                @foreach ($data['icons'] as $icon)
                    <tr role="row" id="{{ 'icon_'.$icon->id }}">
                        <td class="image"><a class="img-preview" href="{{ asset('images/icons/icon'.$icon->id.'.png') }}"><img src="{{ asset('images/icons/icon'.$icon->id.'.svg') }}" /></a></td>
                        <td class="text-center head">{{ $icon->title }}</td>
                        <td class="text-center">
                            @include('admin.blocks._status_block',[
                                'status' => $icon->active,
                                'description' => $icon->active ? trans('admin.icon_is_active') : trans('admin.icon_not_active')
                              ])
                        </td>
                        @include('admin.blocks._edit_cell_block', ['href' => route($menu[$data['menu_key']]['href'], ['id' => $icon->id])])
                        @include('admin.blocks._delete_cell_block',['id' => $icon->id])
                    </tr>
                @endforeach
            </table>
            @include('admin.blocks._add_button_block',[
                'href' => route($menu[$data['menu_key']]['href']).'/add',
                'text' => trans('admin.add_icon')
            ])
        </div>
    </div>
@endsection
