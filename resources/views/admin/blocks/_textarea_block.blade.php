<x-incover
    name="{{ $name }}"
    required="{{ isset($required) && $required }}"
    error="{{ count($errors) && $errors->has($name) ? $errors->first($name) : '' }}"
    label="{{ isset($label) && $label ? $label : ''  }}"
>
    <textarea class="form-control {{ isset($simple) && $simple ? 'simple' : '' }}" name="{{ $name }}" {{ isset($disabled) && $disabled ? 'disabled=disabled' : '' }}>{{ count($errors) ? old($name) : (isset($value) ? $value : '') }}</textarea>
</x-incover>
@if (!isset($simple) || !$simple)
    <script>
        var editor = CKEDITOR.replace('{{ $name }}', {
            height: '{{ isset($height) ? $height.'px' : '200px' }}'
        });
    </script>
@endif
