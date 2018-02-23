<div
    class="callout extra-large background-image"
    style="background-image: url({!! $blockData->background_image or '' !!});"
>
    <div class="grid-container column text-center">
        <h1>{!! $blockData->title or '' !!}</h1>
        <p class="lead">{!! $blockData->content or '' !!}</p>
        <a href="{!! $blockData->link or '#' !!}" class="button large">
            {!! $blockData->button_text or 'Learn More' !!}
        </a>
    </div> <!-- /.container -->
</div> <!-- /.callout -->