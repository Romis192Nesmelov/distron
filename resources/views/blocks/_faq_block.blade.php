<div class="accordion" id="faq">
    @foreach($faq as $k => $item)
        @include('blocks._accordion_block',[
            'parentId' => 'faq',
            'itemId' => 'question'.$k,
            'itemHead' => $item->question,
            'itemText' => $item->answer
        ])
    @endforeach
</div>
