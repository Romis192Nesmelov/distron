@if (isset($data[$field]))
    <input type="hidden" name="id" value="{{ $data[$field]->id }}">
@endif
