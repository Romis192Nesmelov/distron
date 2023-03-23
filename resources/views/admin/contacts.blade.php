@extends('layouts.admin')

@section('content')
    @include('admin.blocks._modal_delete_block',[
        'modalId' => 'delete-modal',
        'action' => 'delete_contact',
        'head' => trans('admin.do_you_really_want_delete_this_contact')
    ])

    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.contacts') }}</x-atitle>
        <div class="panel-body">
            <div class="panel panel-flat">
                <table class="table table-striped table-items">
                    <tr>
                        <th class="text-center">{{ trans('admin.contact_type') }}</th>
                        <th class="text-center">{{ trans('admin.contact') }}</th>
                        @include('admin.blocks._th_edit_cell_block')
                        @include('admin.blocks._th_delete_cell_block')
                    </tr>

                    @foreach ($data['contacts'] as $contact)
                        @if ($contact->type != 4)
                            <?php
                            switch ($contact->type) {
                                case 1:
                                    $label = trans('content.address');
                                    $contactStr = $contact->contact;
                                    break;
                                case 2:
                                    $label = trans('content.phone');
                                    $contactStr = view('blocks._phone_block',['phone' => $contact->contact])->render();
                                    break;
                                case 3:
                                    $label = 'E-mail';
                                    $contactStr = view('blocks._email_block',['email' => $contact->contact])->render();
                                    break;
                            }
                            ?>
                            <tr role="row" id="{{ 'question_'.$contact->id }}">
                                <td class="text-center head">{{ $label }}</td>
                                <td class="text-center">{!! $contactStr !!}</td>
                                @include('admin.blocks._edit_cell_block', ['href' => route($menu[$data['menu_key']]['href'], ['id' => $contact->id])])
                                @include('admin.blocks._delete_cell_block',['id' => $contact->id])
                            </tr>
                        @else
                            <tr role="row" id="{{ 'question_'.$contact->id }}">
                                <td class="text-center head">{{ trans('admin.map') }}</td>
                                <td class="text-center">{!! $contact->contact !!}</td>
                                @include('admin.blocks._edit_cell_block', ['href' => route($menu[$data['menu_key']]['href'], ['id' => $contact->id])])
                                @include('admin.blocks._delete_cell_block',['id' => $contact->id])
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
            @include('admin.blocks._add_button_block',[
                'href' => route($menu[$data['menu_key']]['href']).'/add',
                'text' => trans('admin.add_contact')
            ])
        </div>
    </div>
@endsection
