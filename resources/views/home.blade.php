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
        <img class="wow animate__animated animate__fadeIn" data-wow-delay="0.5s" id="main-image" src="{{ asset('images/v1/battery.png') }}" />
    </div>

    <x-section wow_delay=".1" data-scroll-destination="{{ $menu['calculator']['scroll'] }}" head="{{ $menu['calculator']['name'] }}">
        <x-row>
            @include('blocks._calculator_block')
        </x-row>
    </x-section>
    <hr>
    <x-section wow_delay=".1" data-scroll-destination="{{ $menu['about_company']['scroll'] }}" head="{{ $menu['about_company']['name'] }}">
        <x-row>
            <div class="col-md-4 col-sm-6 col-xs-12 image">
                <img src="{{ asset('images/v1/bad_to_good.jpg') }}" />
            </div>
            <div class="col-md-8 col-sm-6 col-xs-12 px-5">
                <p>{{ $content[0]->text }}</p>
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

    <x-section class="color color1" wow_delay=".1" data-scroll-destination="{{ $menu['our_services']['scroll'] }}">
        <x-row>
            @include('blocks._color_section_image_content_block',[
                'image' => asset('images/v1/distron-car.png'),
                'head' => $menu['our_services']['name'],
                'text' => $content[1]->text
            ])
        </x-row>
    </x-section>

    <x-section class="white" wow_delay=".1" data-scroll-destination="{{ $menu['battery_requirements']['scroll'] }}" head="{{ $menu['battery_requirements']['name'] }}">
        <x-row>
            @include('blocks._white_section_image_content_block',[
                'image' => asset('images/v1/batteries.jpg'),
                'text' => $content[2]->text
            ])
        </x-row>
    </x-section>

    <x-section class="color color2" wow_delay=".1">
        <x-row>
            <div class="col-md-4 col-sm-6 col-xs-12 mb-3 image">
                <img src="{{ asset('images/distron_shim.png') }}" />
            </div>
            <div class="col-md-8 col-sm-6 col-xs-12">
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
