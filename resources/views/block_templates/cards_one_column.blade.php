<div class="grid-container">
    <div class="block-image-text">
        @if (!empty($blockData->image) && $blockData->image_position == 0)
            <div class="block-image-text-img">
                <img src="{!! $blockData->image or '' !!}">
            </div> <!-- /.block-image-text-img -->
        @endif

        <div class="block-image-text-content">
            @if (!empty($blockData->title))
                <h4>{!! $blockData->title or '' !!}</h4>
            @endif
            
            @if (!empty($blockData->content))
                <p>{!! $blockData->content or '' !!}</p>
            @endif

            @if (!empty($blockData->link))
                <a href="{!! $blockData->link or '' !!}" class="button round">{!! $blockData->button_text or 'Learn More' !!}</a>
            @endif
        </div> <!-- /.block-image-text-content -->

        @if (!empty($blockData->image) && $blockData->image_position == 1)
            <div class="block-image-text-img">
                <img src="{!! $blockData->image or '' !!}">
            </div> <!-- /.block-image-text-img -->
        @endif
    </div> <!-- /.block-image-text -->
</div> <!-- /.grid-container -->

<div class="vspace-medium-2"></div>