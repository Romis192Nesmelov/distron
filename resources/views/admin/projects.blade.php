@extends('layouts.admin')

@section('content')
    @include('admin.blocks._modal_delete_block',[
        'modalId' => 'delete-modal',
        'action' => 'delete_project',
        'head' => trans('content.do_you_really_want_delete_this_project')
    ])

    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.portfolio') }}</x-atitle>
        <div class="panel-body">
            <?php $projectType = $data['projects'][0]->projectType['name_'.app()->getLocale()]; ?>
            @include('admin.blocks._projects_table_start_block')
                @foreach ($data['projects'] as $project)
                    <?php $currentProjectType = $project->projectType['name_'.app()->getLocale()]; ?>
                    @if ($projectType != $currentProjectType)
                        <?php $projectType = $currentProjectType; ?>
                        @include('admin.blocks._table_end_block')
                        @include('admin.blocks._table_start_block')
                    @endif

                    <tr role="row" id="{{ 'project_'.$project->id }}">
                        <td class="image"><a class="img-preview" href="{{ asset($project->images[0]->preview) }}"><img src="{{ asset($project->images[0]->preview) }}" /></a></td>
                        <td class="text-left head">{{ $project['name_'.app()->getLocale()] }}</td>
                        <td class="text-left">@include('blocks._cropped_content_block',['croppingContent' => $project['description_'.app()->getLocale()], 'length' => 300])</td>
                        <td class="text-center">
                            @include('admin.blocks._status_block',[
                                'status' => $project->active,
                                'description' => $project->active ? trans('content.project_is_active') : trans('content.project_not_active')
                              ])
                        </td>
                        @include('admin.blocks._edit_cell_block', ['href' => route($menu[$data['menu_key']]['href'], ['id' => $project->id])])
                        @include('admin.blocks._delete_cell_block',['id' => $project->id])
                    </tr>
                @endforeach
            @include('admin.blocks._table_end_block')
            @include('admin.blocks._add_button_block',[
                'href' => route($menu[$data['menu_key']]['href']).'/add',
                'text' => trans('content.add_project')
            ])
        </div>
    </div>
@endsection
