<!doctype html>
<html>
<head>
    <title>{{ $settings->title }}</title>
    @foreach($metas as $meta => $params)
        @if ($settings[$meta])
            <meta {{ $params['name'] ? 'name='.$params['name'] : 'property='.$params['property'] }} content="{{ $settings[$meta] }}">
        @endif
    @endforeach
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet">

    @include('blocks._favicon_block')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/icons/icomoon/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/components.css') }}" />
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}" />--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.theme.default.min.css') }}" />--}}
    <!-- Custom styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
{{--    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/core/libraries/jquery.min.js') }}"></script>
{{--    <script type="text/javascript" src="{{ asset('js/core/libraries/bootstrap.min.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/fancybox.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/core/libraries/jquery_ui/interactions.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/sliders/ion_rangeslider.min.js') }}"></script>

{{--    <script type="text/javascript" src="{{ asset('js/core/app.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('js/owl.carousel.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/feedback.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/setbackground.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.maskedinput.js') }}"></script>
</head>

<body>
<div id="main" data-scroll-destination="home">
    @yield('content')
</div>

<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 image">
                        <img src="{{ asset('images/distron_shim.png') }}" />
                    </div>
                    <div class="col-md-6 ml-auto">
                        <ul class="list-unstyled">
                            @foreach($menu as $menuItemKey => $menuItem)
                                @include('blocks._nav-item_block', $menuItem)
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ml-auto">
                <div class="mb-5">
                    <h2 class="footer-heading mb-4">Обратная связь</h2>
                    <form class="form useAjax footer-suscribe-form" action="{{ route('request_short') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            @include('blocks._error_block',['name' => 'phone'])
                            <input class="form-control rounded-0 border-secondary text-white bg-transparent" placeholder="+7(___)___-__-__" name="phone">
                            <div class="input-group-append">
                                @include('blocks._button_block',[
                                    'primary' => true,
                                    'addClass' => 'text-white rounded-0',
                                    'dataDismiss' => false,
                                    'buttonType' => 'submit',
                                    'buttonText' => trans('content.call_back'),
                                    'disabled' => true
                                ])
                            </div>
                        </div>
                        @include('blocks._checkbox_block',[
                            'checked' => true,
                            'name' => 'i_agree',
                            'label' => trans('content.i_agree'),
                        ])
                    </form>
                </div>
            </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
                <div class="pt-5">
                    <p class="small">Copyright ©{{ date('Y') }} Distron Technology</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="on-top-button" data-scroll="home"><i class="icon-arrow-up12"></i></div>
</body>
</html>
