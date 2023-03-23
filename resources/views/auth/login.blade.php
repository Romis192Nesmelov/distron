@extends('layouts.auth')

@section('content')

<!-- Advanced login -->
<form method="POST" action="{{ route('enter') }}">
    @csrf
    <div class="panel panel-body login-form">
        <div class="text-center">
            <img width="100" src="{{ asset('images/logo_black.svg') }}" />
            <h5 class="content-group-lg">{{ trans('auth.login_to_your_account') }} <small class="display-block">{!! trans('auth.login_head') !!}</small></h5>
        </div>

        @include('admin.blocks._input_block',[
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'E-mail',
            'icon' => 'icon-user'
        ])
        @include('admin.blocks._input_block',[
            'name' => 'password',
            'type' => 'password',
            'placeholder' => trans('auth.password'),
            'icon' => 'icon-lock2'
        ])

        <div class="form-group login-options">
            <div class="row">
                @include('admin.blocks._checkbox_block', [
                    'name' => 'remember',
                    'checked' => true,
                    'label' => trans('auth.remember_me')
                ])
            </div>
        </div>

        <div class="form-group">
            @include('admin.blocks._button_block', [
                'type' => 'submit',
                'mainClass' => 'bg-warning-400 btn-block',
                'text' => trans('admin.enter'),
                'icon' => 'icon-circle-right2 position-right'
            ])
        </div>
    </div>
</form>
@endsection
