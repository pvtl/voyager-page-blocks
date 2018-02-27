<div
    class="callout callout-size-{!! $blockData->size or '0' !!} background-image @if ($blockData->fade_background === 'on') fade-background @endif"
    style="background-image: url({!! $blockData->background_image or '' !!});"
>
    <div class="grid-container column text-center">
        @if (!empty($blockData->title))
            @if ($blockData->size > 1) <h1> @else <h2> @endif
                {!! $blockData->title or '' !!}
            @if ($blockData->size > 1) </h1> @else </h2> @endif
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