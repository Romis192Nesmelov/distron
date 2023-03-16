<x-incover
    name="{{ $name }}"
    error="{{ count($errors) && $errors->has($name) ? $errors->first($name) : '' }}"
    label="{{ isset($label) && $label ? $label : ''  }}"
>
    <div class="input-group">
        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
        <input type="text" name="{{ $name }}" class="form-control daterange-single" value="{{ !count($errors) ? date('d.m.Y', $value) : old($name) }}" {{ isset($disabled) && $disabled ? 'disabled=disabled' : '' }}>
    </div>
</x-incover>
