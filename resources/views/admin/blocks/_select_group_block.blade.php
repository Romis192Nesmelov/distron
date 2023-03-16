<x-incover
    name="{{ $name }}"
    required="{{ isset($required) && $required }}"
    error="{{ count($errors) && $errors->has($name) ? $errors->first($name) : '' }}"
    label="{{ isset($label) && $label ? $label : ''  }}"
>
    <select {{ isset($disabled) && $disabled ? 'disabled' : '' }} name="{{ $name }}" class="form-control">
        @foreach ($groups as $group => $items)
            <optgroup label="{{ $group }}">
                @foreach ($items as $value => $options)
                    <option value="{{ $value }}" {{ (!count($errors) ? $value == $selected : $value == old($name)) ? 'selected' : '' }}>{{ $options }}</option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
</x-incover>
