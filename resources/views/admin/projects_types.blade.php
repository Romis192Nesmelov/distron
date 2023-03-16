@extends('layouts.admin')

@section('content')
    @include('admin.blocks._modal_delete_block',[
        'modalId' => 'delete-modal',
        'action' => 'delete_projects_type',
        'head' => trans('content.do_you_really_want_delete_this_projects_type')
    ])

    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.projects_types') }}</x-atitle>
        <div class="panel-body">
            <table class="table datatable-basic table-items">
                <tr>
                    <th class="text-center">{{ trans('content.projects_type_image') }}</th>
                    <th class="text-center">{{ trans('content.projects_type_name') }}</th>
                    <th class="text-center">{{ trans('content.projects_type_description') }}</th>
                    <th class="text-center">{{ trans('content.projects_type_status') }}</th>
                    @include('admin.blocks._th_edit_cell_block')
                    @include('admin.blocks._th_delete_cell_block')
                </tr>
                @foreach($data['projects_types'] as $projectType)
                    <tr role="row" id="{{ 'projects_type_'.$projectType->id }}">
                        <td class="image">
                            @if ($projectType->id != 1)
                                <a class="img-preview" href="{{ asset($projectType->image) }}"><img src="{{ asset($projectType->image) }}" /></a>
                            @endif
                        </td>
                        <td class="text-left head">{{ $projectType['name_'.app()->getLocale()] }}</td>
                        <td class="text-left">@include('blocks._cropped_content_block',['croppingContent' => $projectType['description_'.app()->getLocale()], 'length' => 300])</td>
                        <td class="text-center">
                            @if ($projectType->id != 1)
                                @include('admin.blocks._status_block',[
                                    'status' => $projectType->active,
                                    'description' => $projectType->active ? trans('content.projects_type_is_active') : trans('content.projects_type_not_active')
                                  ])
                            @endif
                        </td>
                        @include('admin.blocks._edit_cell_block', ['href' => route($menu[$data['menu_key']]['href'], ['id' => $projectType->id])])
                        @if ($projectType->id != 1)
                            @include('admin.blocks._delete_cell_block',['id' => $projectType->id])
                        @else
                            <td></td>
                        @endif
                    </tr>
                @endforeach
            </table>

            @include('admin.blocks._add_button_block',[
                'href' => route($menu[$data['menu_key']]['href']).'/add',
                'text' => trans('content.add_projects_type')
            ])
        </div>
    </div>
@endsection
