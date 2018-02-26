<div
    class="callout callout-size-{!! $blockData->size or '0' !!} background-image @if ($blockData->fade_background === 'Yes') fade-background @endif"
    style="background-image: url({!! $blockData->background_image or '' !!});"
>
    <div class="grid-container column text-center">
        @if (!empty($blockData->title))
            <h1>{!! $blockData->title or '' !!}</h1>
        @endif

        @if (!empty($blockData->content))
            <p class="lead">{!! $blockData->content or '' !!}</p>
        @endif
        
        @if (!empty($blockData->link))
            <a href="{!! $blockData->link or '#' !!}" class="button large">
                {!! $blockData->button_text or 'Learn More' !!}
            </a>
        @endif
    </div> <!-- /.container -->
</div> <!-- /.callout -->

<div class="vspace-medium-2"></div>