@extends('layouts.admin')

@section('content')
    @include('admin.blocks._modal_delete_block',[
        'modalId' => 'delete-modal',
        'action' => 'delete_metric',
        'head' => trans('admin.do_you_really_want_delete_this_metric')
    ])

    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.metrics') }}</x-atitle>
        <div class="panel-body">
            <div class="panel panel-flat">
                <table class="table table-striped table-items">
                    <tr>
                        <th class="text-center">{{ trans('admin.metric_name') }}</th>
                        <th class="text-center">{{ trans('admin.metric_status') }}</th>
                        @include('admin.blocks._th_edit_cell_block')
                        @include('admin.blocks._th_delete_cell_block')
                    </tr>

                    @foreach ($data['metrics'] as $metric)
                        <tr role="row" id="{{ 'metric_'.$metric->id }}">
                            <td class="text-center head">{{ $metric->name }}</td>
                            <td class="text-center">
                                @include('admin.blocks._status_block',[
                                    'status' => $metric->active,
                                    'description' => $metric->active ? trans('admin.metric_is_active') : trans('admin.metric_not_active')
                                  ])
                            </td>
                            @include('admin.blocks._edit_cell_block', ['href' => route($menu[$data['menu_key']]['href'], ['id' => $metric->id])])
                            @include('admin.blocks._delete_cell_block',['id' => $metric->id])
                        </tr>
                    @endforeach
                </table>
            </div>
            @include('admin.blocks._add_button_block',[
                'href' => route($menu[$data['menu_key']]['href']).'/add',
                'text' => trans('admin.add_metric')
            ])
        </div>
    </div>
@endsection
