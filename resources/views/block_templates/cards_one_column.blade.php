<div class="grid-container">
    <div class="block-image-text">
        <div class="block-image-text-img">
            <img src="{!! $blockData->image or '' !!}">
        </div> <!-- /.block-image-text-img -->

        <div class="block-image-text-content">
            <h4>{!! $blockData->title or '' !!}</h4>
            <p>{!! $blockData->content or '' !!}</p>
            <a href="{!! $blockData->link or '' !!}" class="button round">{!! $blockData->button_text or '' !!}</a>
        </div> <!-- /.block-image-text-content -->
    </div> <!-- /.block-image-text -->
</div> <!-- /.grid-container -->