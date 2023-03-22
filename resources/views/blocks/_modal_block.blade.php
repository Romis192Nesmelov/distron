<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @if (isset($modalHead) && $modalHead)
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalHead }}</h1>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ trans('content.close') }}"></button>
            </div>
            @if (isset($modalContent) && $modalContent)
                {!! $modalContent !!}
            @else
                <div class="modal-body">
                    <h3>{{ $contentHead }}</h3>
                </div>
                <div class="modal-footer">
                    @include('blocks._button_secondary_block',[
                        'primary' => false,
                        'dataDismiss' => true,
                        'buttonText' => trans('content.close')
                    ])
                </div>
            @endif
        </div>
    </div>
</div>
