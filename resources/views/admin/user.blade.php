@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks._title_block')
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_user') }}" method="post">
                @csrf
                @include('admin.blocks._hidden_id_block',['field' => 'user'])
                <div class="panel panel-flat">
                    <div class="panel-body">
                        @include('admin.blocks._input_block', [
                            'label' => 'E-mail',
                            'name' => 'email',
                            'type' => 'email',
                            'max' => 100,
                            'placeholder' => 'E-mail',
                            'value' => isset($data['user']) ? $data['user']->email : ''
                        ])

                        <div class="panel panel-flat">
                            @if (isset($data['user']))
                                <div class="panel-heading">
                                    <h4 class="text-grey-300">{{ trans('content.if_you_doesnt_want_to_change_password') }}</h4>
                                </div>
                            @endif

                            <div class="panel-body">
                                @include('admin.blocks._input_block', [
                                    'label' => trans('content.user_password'),
                                    'name' => 'password',
                                    'type' => 'password',
                                    'max' => 50,
                                    'placeholder' => trans('content.user_password'),
                                    'value' => ''
                                ])

                                @include('admin.blocks._input_block', [
                                    'label' => trans('content.confirm_password'),
                                    'name' => 'password_confirmation',
                                    'type' => 'password',
                                    'max' => 50,
                                    'placeholder' => trans('content.confirm_password'),
                                    'value' => ''
                                ])

                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
@endsection
