@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks._title_block')
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_contact') }}" method="post">
                @csrf
                @include('admin.blocks._hidden_id_block',['field' => 'contact'])
                <div class="panel panel-flat">
                    <div class="panel-body">
                        @include('admin.blocks._input_block', [
                            'required' => true,
                            'label' => ucfirst($data['contact']->type),
                            'name' => 'contact',
                            'type' => 'text',
                            'placeholder' => ucfirst($data['contact']->type),
                            'value' => $data['contact']->contact
                        ])
                    </div>
                </div>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        @include('admin.blocks._checkbox_block',[
                            'name' => 'active',
                            'label' => trans('content.contact_active'),
                            'checked' => $data['contact']->active
                        ])
                    </div>
                </div>
                @include('admin.blocks._save_button_block')
            </form>
        </div>
    </div>
@endsection
