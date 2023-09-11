@extends('layouts.main')

@section('content')
    @php ob_start(); @endphp
    <form class="form useAjax col-12" action="{{ route('request') }}">
        @csrf
        <div class="modal-body">
            @include('blocks._request_block')
        </div>
        <div class="modal-footer">
            @include('blocks._button_secondary_block',[
                'primary' => false,
                'dataDismiss' => true,
                'buttonText' => trans('content.close')
            ])
            @include('blocks._button_block',[
                'primary' => true,
                'dataDismiss' => false,
                'buttonType' => 'submit',
                'buttonText' => trans('content.send'),
                'disabled' => true
            ])
        </div>
    </form>

    @include('blocks._modal_block',[
        'modalId' => 'request-modal',
        'modalHead' => trans('content.leave_request'),
        'modalContent' => ob_get_clean()
    ])

    @include('blocks._modal_block',[
        'modalId' => 'thanks-modal',
        'modalHead' => trans('content.thanks_for_your_request'),
        'contentHead' => trans('content.we_will_contact_you')
    ])

    <div id="main-collage">
        @include('blocks._main_nav_block', ['mainId' => 'main-nav', 'collapseId' => 'main-nav-bar'])
        <div id="main-logo">
            <img class="logo wow animate__animated animate__fadeIn" data-wow-delay=".2s" src="{{ asset('images/logo.svg') }}" />
            <h1 class="wow animate__animated animate__fadeIn" data-wow-delay=".3s">Новая жизнь Вашего аккумулятора</h1>
            @include('blocks._button_block',[
                'primary' => true,
                'addClass' => 'wow animate__animated animate__fadeIn',
                'addAttr' => ['data-wow-delay' => '.3s'],
                'dataTarget' => 'request-modal',
                'buttonText' => trans('content.leave_request')
            ])
        </div>
        <img class="wow animate__animated animate__fadeIn" data-wow-delay="0.5s" id="main-image" src="{{ asset('images/battery.png') }}" />
    </div>

    <x-section wow_delay=".1" data-scroll-destination="{{ Str::slug($content[0]->head) }}" head="{{ $content[0]->head }}">
        <x-row>
            <div class="col-12 col-lg-4 image">
                <img src="{{ asset($content[0]->images[0]->preview) }}" />
            </div>
            <div class="col-12 col-lg-8">
                {!! $content[0]->text !!}
            </div>
        </x-row>
    </x-section>
    <hr>
    <x-section class="icons" wow_delay=".1" data-scroll-destination="{{ $menu['advantages']['scroll'] }}" head="{{ $menu['advantages']['name'] }}">
        <x-row>
            @foreach($icons as $k => $icon)
                @include('blocks._icon_block',[
                    'col' => 3,
                    'delay' => $k,
                    'icon' => $icon
                ])
            @endforeach
        </x-row>
    </x-section>

    <x-section class="color color1" wow_delay=".1" data-scroll-destination="{{ Str::slug($content[1]->head) }}">
        <x-row class="pb-4 pt-4 d-flex justify-content-center">
            @include('blocks._color_section_image_content_block',[
                'images' => $content[1]->images,
                'imageCol' => 6,
                'head' => $content[1]->head,
                'text' => $content[1]->text
            ])
        </x-row>
    </x-section>

    <x-section class="white" wow_delay=".1" data-scroll-destination="{{ $menu['news']['scroll'] }}" head="{{ $menu['news']['name'] }}">
        <x-row>
            @foreach($news as $k => $new)
                <div class="wow animate__animated animate__fadeIn col-lg-4 col-md-6 my-2" data-wow-delay="{{ ($k+1) * 0.5 }}s">
                    <div class="news-entry-contents">
                        <div class="news-date">{{ date('d.m.Y',$new->time) }}</div>
                        <div class="image-cover" bg="{{ asset('images/news/news'.$new->id.'.jpg') }}"></div>
                        <h2>{{ $new->head }}</h2>
                        <div class="my-3">
                            {!! $new->text !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </x-row>
    </x-section>
    <hr>
    <x-section wow_delay=".1" data-scroll-destination="{{ Str::slug($content[2]->head) }}" head="{{ $content[2]->head }}">
        <x-row>
            @include('blocks._white_section_image_content_block',[
                'colImage' => 3,
                'image' => asset($content[2]->images[0]->preview),
                'text' => $content[2]->text
            ])
        </x-row>
    </x-section>

    <x-section class="color color2" wow_delay=".1">
        <x-row>
            <div class="col-md-4 col-sm-4 col-xs-12 mb-3 image">
                <img src="{{ asset('images/distron_shim.png') }}" />
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <h2>{{ trans('content.leave_request') }}</h2>
                <form class="form useAjax col-12" action="{{ route('request') }}">
                    @csrf
                    @include('blocks._request_block')
                    @include('blocks._button_block',[
                        'primary' => true,
                        'addClass' => 'mb-4 col-3 float-end',
                        'buttonType' => 'submit',
                        'buttonText' => trans('content.send'),
                        'disabled' => true
                    ])
                </form>
            </div>
        </x-row>
    </x-section>

    <x-section class="white" wow_delay=".1" data-scroll-destination="{{ $menu['faq']['scroll'] }}" head="{{ $menu['faq']['name'] }}">
        <x-row>
            @include('blocks._faq_block')
        </x-row>
    </x-section>
    <hr>
    <x-section wow_delay=".1" data-scroll-destination="{{ $menu['contacts']['scroll'] }}" head="{{ $menu['contacts']['name'] }}">
        <x-row>
            @include('blocks._contacts_block')
        </x-row>
    </x-section>
@endsection
