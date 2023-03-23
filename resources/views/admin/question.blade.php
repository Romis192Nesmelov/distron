@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks._title_block')
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_faq') }}" method="post">
                @csrf
                @include('admin.blocks._hidden_id_block',['field' => 'content'])
                @include('admin.blocks._input_block', [
                    'label' => trans('admin.question'),
                    'name' => 'question',
                    'type' => 'text',
                    'max' => 255,
                    'placeholder' => trans('admin.question'),
                    'value' => isset($data['question']) ? $data['question']->question : ''
                ])
                @include('admin.blocks._textarea_block',[
                    'label' => trans('admin.answer'),
                    'name' => 'answer',
                    'simple' => true,
                    'value' => isset($data['question']) ? $data['question']->answer : ''
                ])
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
@endsection
