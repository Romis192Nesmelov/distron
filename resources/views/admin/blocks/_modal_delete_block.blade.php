@php ob_start(); @endphp
<div class="modal-body modal-delete" del-function="{{ route('admin.'.$action) }}" >
    <h3>{{ $head }}</h3>
</div>
<!-- Футер модального окна -->
<div class="modal-footer">
    @include('admin.blocks._button_block', [
        'type' => 'button',
        'text' => trans('content.yes'),
        'addClass' => 'delete-yes'
    ])
    @include('admin.blocks._button_block', [
        'type' => 'button',
        'text' => trans('content.no'),
        'addAttr' => ['data-dismiss' => 'modal']
    ])
</div>
@include('admin.blocks._modal_block',['id' => $modalId, 'title' => trans('admin.warning'), 'content' => ob_get_clean()])
