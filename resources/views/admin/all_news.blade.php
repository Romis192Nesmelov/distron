@extends('layouts.admin')

@section('content')
    @include('admin.blocks._modal_delete_block',[
        'modalId' => 'delete-modal',
        'action' => 'delete_news',
        'head' => trans('content.do_you_really_want_delete_this_news')
    ])

    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.news') }}</x-atitle>
        <div class="panel-body">
            <table class="table datatable-basic table-items">
                <tr>
                    <th class="text-center">{{ trans('content.news_image') }}</th>
                    <th class="text-center">{{ trans('content.title_news') }}</th>
                    <th class="text-center">{{ trans('content.content_news') }}</th>
                    <th class="text-center">{{ trans('content.date_news') }}</th>
                    @include('admin.blocks._th_edit_cell_block')
                    @include('admin.blocks._th_delete_cell_block')
                </tr>
                @foreach ($data['news'] as $news)
                    <tr role="row" id="{{ 'news_'.$news->id }}">
                        <td class="image"><a class="img-preview" href="{{ asset($news->image) }}"><img src="{{ asset($news->image) }}" /></a></td>
                        <td class="text-left head">{{ $news['title_'.app()->getLocale()] }}</td>
                        <td class="text-left">@include('blocks._cropped_content_block',['croppingContent' => $news['content_'.app()->getLocale()], 'length' => 300])</td>
                        <td class="text-center">{{ date('d.m.Y', $news->time) }}</td>
                        @include('admin.blocks._edit_cell_block', ['href' => route($menu[$data['menu_key']]['href'], ['id' => $news->id])])
                        @include('admin.blocks._delete_cell_block',['id' => $news->id])
                    </tr>
                @endforeach
            </table>
            @include('admin.blocks._add_button_block',[
                'href' => route($menu[$data['menu_key']]['href']).'/add',
                'text' => trans('content.add_news')
            ])
        </div>
    </div>
@endsection
