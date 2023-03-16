@extends('layouts.main')

@section('content')
    @include('blocks._main_nav_block', ['mainId' => 'skew-nav', 'collapseId' => 'skew-nav-bar'])
    <div id="skew-collage-cover">
        <div id="skew-collage">
            @for($c=0;$c<4;$c++)
                <img class="cell cell{{ $c+1 }}" src="{{ asset('images/collage/mc_cell'.($c+1).'.png') }}" />
            @endfor
            <img class="logo" src="{{ asset('images/logo_glow.png') }}" />
        </div>
    </div>

    <x-section wow_delay=".1" data-scroll-destination="{{ $menu['calculator']['scroll'] }}" head="{{ $menu['calculator']['name'] }}">
        <x-row>
            @include('blocks._calculator_block')
        </x-row>
    </x-section>
    <hr>
    <x-section class="color color3" wow_delay=".1" data-scroll-destination="{{ $menu['about_company']['scroll'] }}">
        <x-row class="d-flex align-items-center">
            <div class="col-md-3 col-sm-6 col-xs-12 image cir-image">
                <img src="{{ asset('images/cir_img.jpg') }}" />
            </div>
            <div class="col-md-9 col-sm-6 col-xs-12 px-5">
                <h1>{{ $menu['about_company']['name'] }}</h1>
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
    <hr>
    <x-section wow_delay=".1" data-scroll-destination="{{ $menu['our_services']['scroll'] }}" head="{{ $menu['our_services']['name'] }}">
        <x-row>
            <div class="col-md-9 col-sm-8 col-xs-12">
                <p>{{ $content[1]->text }}</p>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12 image">
                <img src="{{ asset('images/battery1.png') }}" />
            </div>
        </x-row>
    </x-section>

    <x-section class="color color3" wow_delay=".1" data-scroll-destination="{{ $menu['battery_requirements']['scroll'] }}">
        <x-row>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h1>{{ $menu['battery_requirements']['name'] }}</h1>
                <p>{{ $content[2]->text }}</p>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 image">
                <img src="{{ asset('images/batteries.png') }}" />
            </div>
        </x-row>
    </x-section>

    <x-section wow_delay=".1">
        <x-row class="rounded-plate">
                <div class="col-md-4 col-sm-6 col-xs-12 mb-3 image">
                    <img src="{{ asset('images/distron_shim.png') }}" />
                </div>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    @include('blocks._request_block')
                </div>
        </x-row>
    </x-section>
    <hr>
    <x-section wow_delay=".1" data-scroll-destination="{{ $menu['faq']['scroll'] }}" head="{{ $menu['faq']['name'] }}">
        <x-row>
            @include('blocks._faq_block')
        </x-row>
    </x-section>

    <x-section class="color color3" wow_delay=".1" data-scroll-destination="{{ $menu['contacts']['scroll'] }}">
        <x-row>
            @include('blocks._contacts_block')
        </x-row>
    </x-section>

@endsection
