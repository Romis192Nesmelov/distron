<a {{ isset($href) && $href ? 'href='.$href : ''}} {{ isset($hrefBlank) && $hrefBlank ? 'target=_blank' : '' }}
    class="btn btn-{{ isset($primary) && $primary ? 'primary' : 'secondary' }} {!! isset($addClass) && $addClass ? $addClass : '' !!}"

    @if (isset($dataDismiss) && $dataDismiss)
        data-bs-dismiss="modal"
    @endif
>
    {{ $buttonText }}
</a>
