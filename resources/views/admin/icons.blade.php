@extends('layouts.admin')

@section('content')
    @include('admin.blocks._modal_delete_block',[
        'modalId' => 'delete-modal',
        'action' => 'delete_project',
        'head' => trans('content.delete_why_us')
    ])

    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.why_us') }}</x-atitle>
        <div class="panel-body">
            <?php $iconsType = $data['icons'][0]->military; $iconsHead = $iconsType ? $data['heads'][1] : $data['heads'][0]; ?>
            @include('admin.blocks._icons_table_start_block')
                @foreach ($data['icons'] as $icon)
                    @if ($iconsType != $icon->military)
                        <?php $iconsType = $icon->military; $iconsHead = $iconsType ? $data['heads'][1] : $data['heads'][0];; ?>
                        @include('admin.blocks._table_end_block')
                        @include('admin.blocks._icons_table_start_block')
                    @endif
                    <tr role="row" id="{{ 'icon_'.$icon->id }}">
                        <td class="image"><a class="img-preview" href="{{ asset($icon->icon) }}"><img src="{{ asset($icon->image) }}" /></a></td>
                        <td class="text-center head">{{ $icon['title_'.app()->getLocale()] }}</td>
                        @if (isset($data['use_description']) && $data['use_description'])
                            <td class="text-center">{{ $icon['description_'.app()->getLocale()] }}</td>
                        @endif
                        <td class="text-center">
                            @include('admin.blocks._status_block',[
                                'status' => $icon->active,
                                'description' => $icon->active ? trans('content.icon_is_active') : trans('content.icon_not_active')
                              ])
                        </td>
                        @include('admin.blocks._edit_cell_block', ['href' => route($menu[$data['menu_key']]['href'], ['id' => $icon->id])])
                        @include('admin.blocks._delete_cell_block',['id' => $icon->id])
                    </tr>
                @endforeach
            @include('admin.blocks._table_end_block')
            @include('admin.blocks._add_button_block',[
                'href' => route($menu[$data['menu_key']]['href']).'/add',
                'text' => trans('content.add_icon')
            ])
        </div>
    </div>
@endsection
