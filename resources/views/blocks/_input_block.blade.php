<div class="col-12 mb-3">
    <div class="form-group">
        <label for="{{ $name }}">{{ $label }} <sup>{{ $required ? '*' : '' }}</sup></label>
        <input type="text" id="{{ $name }}" name="{{ $name }}" class="form-control" placeholder="{{ isset($placeholder) && $placeholder ? $placeholder : '' }}">
        @include('blocks._error_block')
    </div>
</div>
