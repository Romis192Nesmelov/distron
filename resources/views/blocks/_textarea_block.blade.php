<div class="col-12 col-lg-10">
    <div class="form-group mb-3">
        <label for="msg">{{ $label }}</label>
        <textarea id="{{ $name }}" name="{{ $name }}" class="md-textarea form-control" rows="{{ $rows }}"></textarea>
        @include('blocks._error_block')
    </div>
</div>
