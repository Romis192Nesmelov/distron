@extends('layouts.mail')

@section('content')
    <h2>Сообщение с сайта {{ env('APP_NAME') }}</h2>
    <p>Сообщение от пользователя с именем: {{ $name }}</p>
    <p>Телефон: {{ $phone }}</p>
    <p>E-mail: {{ $email }}</p>
    @if ($text)
        <p><b>Текст сообщения:</b></p>
        <p>{{ $text }}</p>
    @endif
@endsection
