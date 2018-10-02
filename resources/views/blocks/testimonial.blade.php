<!-- TESTIMONIAL BLOCK -->
<div class="page-block @if (in_array($blockData->spaces, [0, 2])) page-block-space-bottom @endif @if (in_array($blockData->spaces, [1, 2])) page-block-space-top @endif">
    <div class="callout background-color-lightgray featured-testimonial">
        <div class="vspace-2"></div>

        <div class="grid-container text-center">
            <div class="grid-x grid-padding-x">
                <div
                    class="cell medium-8 medium-offset-2"
                    @if (!empty($blockData->animate)) data-scrollreveal @endif
                >
                    @if (!empty($blockData->content))
                        <h3 class="featured-testimonial-quote">{{ $blockData->content }}</h3>
                    @endif

                    @if (!empty($blockData->title))
                        <p class="lead">
                            {{ $blockData->title }}
                            @if (!empty($blockData->sub_title))
                                <cite>{{ $blockData->sub_title }}</cite>
                            @endif
                        </p>
                    @endif

                    @if (!empty($blockData->image))
                        <div class="avatar">
                            <img src="{{ imageUrl($blockData->image, 110, 110, ['crop' => false]) }}" alt="Image 1" />
                        </div> <!-- /.avatar -->
                    @endif
                </div> <!-- /.cell -->
            </div> <!-- /.grid -->
        </div> <!-- /.container -->

        <div class="vspace-1"></div>
    </div> <!-- /.callout -->
</div> <!-- /.page-block -->
<!-- /TESTIMONIAL BLOCK -->
