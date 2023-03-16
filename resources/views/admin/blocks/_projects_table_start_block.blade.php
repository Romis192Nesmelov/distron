<div class="panel panel-flat">
    <div class="panel-body">
        <x-atitle>{{ $projectType }}</x-atitle>
        <table class="table datatable-basic table-items">
            <tr>
                <th class="text-center">{{ trans('content.project_image') }}</th>
                <th class="text-center">{{ trans('content.project_name') }}</th>
                <th class="text-center">{{ trans('content.project_description') }}</th>
                <th class="text-center">{{ trans('content.project_status') }}</th>
                @include('admin.blocks._th_edit_cell_block')
                @include('admin.blocks._th_delete_cell_block')
            </tr>
