<a
    class="btn btn-{{ isset($primary) && $primary ? 'primary' : (isset($cta) && $cta ? 'cta' : 'secondary') }}
    {{ isset($addClass) && $addClass ? $addClass : '' }}"
    {{ isset($href) && $href ? 'href='.$href : '' }}
    @if (isset($dataTarget) && $dataTarget) data-toggle="modal" data-target="#{{ $dataTarget }}" @endif
>{{ $text }}</a>
