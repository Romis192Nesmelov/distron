@extends('layouts.admin')

@section('content')
    @include('admin.blocks._modal_delete_block',[
        'modalId' => 'delete-modal',
        'action' => 'delete_accumulator',
        'head' => trans('admin.do_you_really_want_delete_this_accumulator')
    ])

    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.accumulators') }}</x-atitle>
        <div class="panel-body">
            <div class="panel panel-flat">
                <table class="table table-striped table-items">
                    <tr>
                        <th class="text-center">{{ trans('content.accumulator_type') }}</th>
                        <th class="text-center">{{ trans('admin.accumulator_status') }}</th>
                        @include('admin.blocks._th_edit_cell_block')
                        @include('admin.blocks._th_delete_cell_block')
                    </tr>

                    @foreach ($data['accumulators'] as $accumulator)
                        <tr role="row" id="{{ 'accumulator_'.$accumulator->id }}">
                            <td class="text-center head">{{ $accumulator->name }}</td>
                            <td class="text-center">
                                @include('admin.blocks._status_block',[
                                    'status' => $accumulator->active,
                                    'description' => $accumulator->active ? trans('admin.accumulator_active') : trans('admin.accumulator_not_active')
                                  ])
                            </td>
                            @include('admin.blocks._edit_cell_block', ['href' => route($menu[$data['menu_key']]['href'], ['id' => $accumulator->id])])
                            @include('admin.blocks._delete_cell_block',['id' => $accumulator->id])
                        </tr>
                    @endforeach
                </table>
            </div>
            @include('admin.blocks._add_button_block',[
                'href' => route($menu[$data['menu_key']]['href']).'/add',
                'text' => trans('admin.add_icon')
            ])
        </div>
    </div>
@endsection
