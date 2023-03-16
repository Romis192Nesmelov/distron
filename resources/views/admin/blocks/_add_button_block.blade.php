<a href="{{ $href }}">@include('admin.blocks._button_block', [
    'type' => 'button',
    'icon' => 'icon-database-add',
    'text' => $text,
    'addClass' => (isset($addClass) ? $addClass.' ' : '').'pull-right'])
</a>
