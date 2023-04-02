<nav id="{{ $mainId }}" class="navbar navbar-expand-lg">
{{--    <a class="navbar-brand" href="#">Navbar</a>--}}
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-controls="{{ $collapseId }}" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-navicon"></i>
    </button>
    <div class="collapse navbar-collapse" id="{{ $collapseId }}">
        <ul class="navbar-nav mr-auto">
            @include('blocks._nav-item_block', [
                'name' => '<i class="icon-home2"></i>',
                'scroll' => 'home1'
            ])
            @foreach($menu as $menuItemKey => $menuItem)
                @include('blocks._nav-item_block', $menuItem)
            @endforeach
{{--            @include('blocks._nav-item_block', [--}}
{{--                'name' => trans('menu.language').' <i class="icon-earth"></i>',--}}
{{--                'dropdown' => [--}}
{{--                    ['name' => trans('menu.ru'), 'href' => route('change_lang',['lang' => 'ru'])],--}}
{{--                    ['name' => trans('menu.en'), 'href' => route('change_lang',['lang' => 'en'])],--}}
{{--                ]--}}
{{--            ])--}}
        </ul>
    </div>
</nav>
