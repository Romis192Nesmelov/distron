@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.contacts') }}</x-atitle>
        <div class="panel-body">
            <table class="table datatable-basic table-items">
                <tr>
                    <th class="text-center">{{ trans('content.contact_image') }}</th>
                    <th class="text-center">{{ trans('content.contact_name') }}</th>
                    <th class="text-center">{{ trans('content.contact') }}</th>
                    <th class="text-center">{{ trans('content.contact_status') }}</th>
                    <th class="text-center">{{ trans('content.last_edit') }}</th>
                    @include('admin.blocks._th_edit_cell_block')
                </tr>
                @foreach ($data['contacts'] as $contact)
                    <tr role="row" id="{{ 'contact_'.$contact->id }}">
                        <td class="image"><img style="border: none;" src="{{ asset($contact->icon) }}" /></td>
                        <td class="text-left head">{{ ucfirst($contact->type) }}</td>
                        <td class="text-left">{{ $contact->contact }}</td>
                        <td class="text-center">
                            @include('admin.blocks._status_block',[
                                                                    'status' => $contact->active,
                                                                    'description' => $contact->active ? trans('content.contact_active') : trans('content.contact_not_active')
                                                                  ])
                        </td>
                        <td class="text-center">{{ $contact->updated_at->format('d.m.Y') }}</td>
                        @include('admin.blocks._edit_cell_block', ['href' => route($menu[$data['menu_key']]['href'], ['id' => $contact->id])])
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
