@php
if (isset($styles) && is_array($styles) && count($styles)) {
    $stylesStr = '';
    foreach ($styles as $key => $val) {
        $stylesStr .= $key.':'.$val.(is_integer($val) ? 'px' : '').';';
    }
}
@endphp
<li {{ isset($id) && $id ? 'id='.$id : '' }} class="nav-item {{ isset($active) && $active ? 'active' : '' }} {{ isset($addClass) && $addClass ? $addClass : '' }} {{ isset($dropdown) && is_array($dropdown) ? 'dropdown' : '' }}" {{ isset($stylesStr) ? 'style='.$stylesStr : '' }}>
    @if (isset($dropdown) && is_array($dropdown))
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown{{ $menuItemKey }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{!! $name !!}</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $menuItemKey }}">
            @foreach($dropdown as $subMenu)
                <a class="dropdown-item" href="{{ $subMenu['href'] }}">{{ $subMenu['name'] }}</a>
            @endforeach
        </div>
    @else
        <a class="nav-link" {{ isset($href) ? 'href='.$href : (request()->path() == '/' || !isset($useRoot) || !$useRoot ? 'data-scroll='.$scroll : 'href=/?scroll='.$scroll) }}>{!! $name !!}</a>
    @endif
</li>
