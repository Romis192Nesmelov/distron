@extends('layouts.mail')

@section('content')
    <h2>Заявка с сайта {{ env('APP_NAME') }}</h2>
    @if (isset($name) && $name)
        <p>От пользователя с именем: {{ $name }}</p>
    @endif
    <p>Телефон: {{ $phone }}</p>
    @if (isset($name) && $name)
        <p>E-mail: {{ $name }}</p>
    @endif
    @if (isset($text) && $text)
        <p><b>Текст сообщения:</b></p>
        <p>{{ $text }}</p>
    @endif
@endsection
