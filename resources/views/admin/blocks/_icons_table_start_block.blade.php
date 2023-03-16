<div class="panel panel-flat">
    <div class="panel-body">
        <x-atitle>{{ $iconsHead }}</x-atitle>
        <table class="table datatable-basic table-items">
            <tr>
                <th class="text-center">{{ trans('content.icon') }}</th>
                <th class="text-center">{{ trans('content.head_icon') }}</th>
                @if (isset($data['use_description']) && $data['use_description'])
                    <th class="text-center">{{ trans('content.description_icon') }}</th>
                @endif
                <th class="text-center">{{ trans('content.icon_status') }}</th>
                @include('admin.blocks._th_edit_cell_block')
                @include('admin.blocks._th_delete_cell_block')
            </tr>
