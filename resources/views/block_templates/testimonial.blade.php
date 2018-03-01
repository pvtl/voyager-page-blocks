<div class="callout background-color-lightgray featured-testimonial">
    <div class="vspace-2"></div>

    <div class="grid-container text-center">
        <div class="grid-x grid-padding-x">
            <div class="cell medium-8 medium-offset-2">
                @if (!empty($blockData->content))
                    <h3 class="featured-testimonial-quote">{!! $blockData->content or '' !!}</h3>
                @endif

                @if (!empty($blockData->title))
                    <p class="lead">
                        {!! $blockData->title or '' !!}
                        @if (!empty($blockData->sub_title))
                            <cite>{!! $blockData->sub_title or '' !!}</cite>
                        @endif
                    </p>
                @endif

                @if (!empty($blockData->image))
                    <div class="avatar">
                        <img src="{!! $blockData->image or '' !!}" alt="Image 1" />
                    </div> <!-- /.avatar -->
                @endif
            </div> <!-- /.cell -->
        </div> <!-- /.grid -->
    </div> <!-- /.container -->

    <div class="vspace-1"></div>
</div> <!-- /.callout -->

<div class="vspace-medium-2"></div>