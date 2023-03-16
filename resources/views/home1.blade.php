@extends('layouts.main')

@section('content')
    <div id="main-collage">
        @include('blocks._main_nav_block', ['mainId' => 'main-nav', 'collapseId' => 'main-nav-bar'])
        <div id="main-logo">
            <img class="logo wow animate__animated animate__fadeIn" data-wow-delay=".2s" src="{{ asset('images/logo.svg') }}" />
            <h1>Новая жизнь Вашего аккумулятора</h1>
            @include('blocks._button_block',[
                'primary' => true,
                'dataTarget' => 'feedback-modal',
                'text' => 'Оставить заявку'
            ])
        </div>
        <img class="wow animate__animated animate__fadeIn" data-wow-delay="0.5s" id="main-image" src="{{ asset('images/battery.png') }}" />
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
                <img src="{{ asset('images/bad_to_good.jpg') }}" />
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
                'image' => asset('images/distron-car.png'),
                'head' => $menu['our_services']['name'],
                'text' => $content[1]->text
            ])
        </x-row>
    </x-section>

    <x-section class="white" wow_delay=".1" data-scroll-destination="{{ $menu['battery_requirements']['scroll'] }}" head="{{ $menu['battery_requirements']['name'] }}">
        <x-row>
            @include('blocks._white_section_image_content_block',[
                'image' => asset('images/batteries.jpg'),
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
                @include('blocks._request_block')
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
