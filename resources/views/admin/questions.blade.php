@extends('layouts.admin')

@section('content')
    @include('admin.blocks._modal_delete_block',[
        'modalId' => 'delete-modal',
        'action' => 'delete_faq',
        'head' => trans('admin.do_you_really_want_delete_this_question')
    ])

    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.faq') }}</x-atitle>
        <div class="panel-body">
            <div class="panel panel-flat">
                <table class="table table-striped table-items">
                    <tr>
                        <th class="text-center">{{ trans('admin.question') }}</th>
                        <th class="text-center">{{ trans('admin.answer') }}</th>
                        <th class="text-center">{{ trans('admin.icon_status') }}</th>
                        @include('admin.blocks._th_edit_cell_block')
                        @include('admin.blocks._th_delete_cell_block')
                    </tr>

                    @foreach ($data['questions'] as $question)
                        <tr role="row" id="{{ 'question_'.$question->id }}">
                            <td class="text-left head">{{ $question->question }}</td>
                            <td class="text-left">{{ $question->answer }}</td>
                            <td class="text-center">
                                @include('admin.blocks._status_block',[
                                    'status' => $question->active,
                                    'description' => $question->active ? trans('admin.question_is_active') : trans('admin.question_not_active')
                                ])
                            </td>
                            @include('admin.blocks._edit_cell_block', ['href' => route($menu[$data['menu_key']]['href'], ['id' => $question->id])])
                            @include('admin.blocks._delete_cell_block',['id' => $question->id])
                        </tr>
                    @endforeach
                </table>
            </div>
            @include('admin.blocks._add_button_block',[
                'href' => route($menu[$data['menu_key']]['href']).'/add',
                'text' => trans('admin.add_question')
            ])
        </div>
    </div>
@endsection
