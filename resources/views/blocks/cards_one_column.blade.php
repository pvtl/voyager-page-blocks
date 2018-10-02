<!-- ONE CARD BLOCK -->
<div class="page-block @if (in_array($blockData->spaces, [0, 2])) page-block-space-bottom @endif @if (in_array($blockData->spaces, [1, 2])) page-block-space-top @endif">
    <div class="grid-container">
        <div class="block-image-text" @if (!empty($blockData->animate)) data-scrollreveal @endif>
            @if (!empty($blockData->image_1) && $blockData->image_position_1 == 0)
                <div class="block-image-text-img">
                    <img src="{{ imageUrl($blockData->image_1, 590, null, ['crop' => false]) }}">
                </div> <!-- /.block-image-text-img -->
            @endif

            <div class="block-image-text-content">
                @if (!empty($blockData->title_1))
                    <h4>{{ $blockData->title_1 }}</h4>
                @endif

                @if (!empty($blockData->content_1))
                    <p>{{ $blockData->content_1 }}</p>
                @endif

                @if (!empty($blockData->link_1))
                    <a href="{{ $blockData->link_1 }}" class="button round">{{ $blockData->button_text_1 }}</a>
                @endif
            </div> <!-- /.block-image-text-content -->

            @if (!empty($blockData->image_1) && $blockData->image_position_1 == 1)
                <div class="block-image-text-img">
                    <img src="{{ imageUrl($blockData->image_1, 590, null, ['crop' => false]) }}">
                </div> <!-- /.block-image-text-img -->
            @endif
        </div> <!-- /.block-image-text -->
    </div> <!-- /.grid-container -->
</div> <!-- /.page-block -->
<!-- /ONE CARD BLOCK -->
