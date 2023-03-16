@extends('layouts.admin')

@section('content')
    @include('admin.blocks._modal_delete_block',[
        'modalId' => 'delete-modal',
        'action' => 'delete_user',
        'head' => trans('content.do_you_really_want_delete_this_user')
    ])

    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.admins') }}</x-atitle>
        <div class="panel-body">
            <table class="table table-striped table-items">
                <tr>
                    <th class="text-center">E-mail</th>
                    @include('admin.blocks._th_created_at_cell_block')
                    @include('admin.blocks._th_edit_cell_block')
                    @include('admin.blocks._th_delete_cell_block')
                </tr>
                @foreach ($data['users'] as $user)
                    <tr role="row" id="{{ 'user_'.$user->id }}">
                        <td class="text-center head">{{ $user->email }}</td>
                        <td class="text-center">{{ $user->created_at }}</td>
                        @include('admin.blocks._edit_cell_block', ['href' => route($menu[$data['menu_key']]['href'], ['id' => $user->id])])
                        @include('admin.blocks._delete_cell_block',['id' => $user->id])
                    </tr>
                @endforeach
            </table>
            @include('admin.blocks._add_button_block',[
                'href' => route($menu[$data['menu_key']]['href']).'/add',
                'text' => trans('content.add_user')
            ])
        </div>
    </div>
@endsection
