<div class="col-12 col-lg-10">
    <div class="form-group mt-3">
        <div class="form-check pl-0">
            <input type="checkbox" class="form-check-input" id="{{ $name }}" name="{{ $name }}">
            <label class="form-check-label d-flex align-items-center txt-sm" for="{{ $name }}">{!! $label !!}</label>
            @include('blocks._error_block')
        </div>
    </div>
</div>
