@extends('layouts.admin')

@section('content')
    @include('admin.blocks._modal_delete_block',[
        'modalId' => 'delete-modal',
        'action' => 'delete_news',
        'head' => trans('admin.do_you_really_want_delete_this_news')
    ])

    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.news') }}</x-atitle>
        <div class="panel-body">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <table class="table datatable-basic table-items">
                        <tr>
                            <th class="text-center">{{ trans('admin.news_image') }}</th>
                            <th class="text-center">{{ trans('admin.head_news') }}</th>
                            <th class="text-center">{{ trans('admin.news_content') }}</th>
                            <th class="text-center">{{ trans('admin.news_date') }}</th>
                            <th class="text-center">{{ trans('admin.news_status') }}</th>
                            @include('admin.blocks._th_edit_cell_block')
                            @include('admin.blocks._th_delete_cell_block')
                        </tr>

                        @foreach ($data['news'] as $news)
                            <tr role="row" id="{{ 'news_'.$news->id }}">
                                <td class="image">
                                    <a class="img-preview" href="{{ asset('images/news/news'.$news->id.'.jpg') }}">
                                        <div class="image-cover" bg="{{ asset('images/news/news'.$news->id.'.jpg') }}"></div>
                                    </a>
                                </td>
                                <td class="text-center head">{{ $news->head }}</td>
                                <td class="text-left">{!! $news->text !!}</td>
                                <td class="text-center">{{ date('d.n.Y',$news->time) }}</td>
                                <td class="text-center">
                                    @include('admin.blocks._status_block',[
                                        'status' => $news->active,
                                        'description' => $news->active ? trans('admin.news_is_active') : trans('admin.news_not_active')
                                      ])
                                </td>
                                @include('admin.blocks._edit_cell_block', ['href' => route($menu[$data['menu_key']]['href'], ['id' => $news->id])])
                                @include('admin.blocks._delete_cell_block',['id' => $news->id])
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @include('admin.blocks._add_button_block',[
                'href' => route($menu[$data['menu_key']]['href']).'/add',
                'text' => trans('admin.add_news')
            ])
        </div>
    </div>
@endsection
