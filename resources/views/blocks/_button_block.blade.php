<?php if (isset($addAttr) && is_array($addAttr)) {
    $attrStr = '';
    foreach ($addAttr as $attr => $value) {
        $attrStr .= $attr.'="'.$value.'"';
    }
}
?>
<button type="{{ isset($buttonType) && $buttonType ? $buttonType : 'button' }}"
    class="btn btn-{{ isset($primary) && $primary ? 'primary' : 'secondary' }} {!! isset($addClass) && $addClass ? $addClass : '' !!}"
    @if (isset($attrStr) && $attrStr)
        {!! $attrStr !!}
    @endif

    @if (isset($dataTarget) && $dataTarget)
        data-bs-toggle="modal" data-bs-target="#{{ $dataTarget }}"
    @elseif (isset($disabled) && $disabled)
        disabled="$disabled"
    @endif
>
    {{ $buttonText }}
</button>
