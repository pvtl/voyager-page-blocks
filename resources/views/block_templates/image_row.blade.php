<!-- IMAGE ROW BLOCK -->
<div class="page-block @if (in_array($blockData->spaces, [0, 2])) page-block-space-bottom @endif @if (in_array($blockData->spaces, [1, 2])) page-block-space-top @endif">
    <div class="background-color-lightgray">
        <div class="vspace-small-2"></div>

        <div class="grid-container">
            <div class="grid-x grid-padding-x">
                <div class="cell small-6 medium-4 large-2" data-scrollreveal>
                    @if (!empty($blockData->image1))
                        @if (!empty($blockData->link1))<a href="{!! $blockData->link1 !!}">@endif
                            <img src="{!! $blockData->image1 or '' !!}" class="thumbnail" alt="Image 1" />
                        @if (!empty($blockData->link1))</a>@endif
                    @endif
                </div> <!-- /.cell -->

                <div class="cell small-6 medium-4 large-2" data-scrollreveal>
                    @if (!empty($blockData->image2))
                        @if (!empty($blockData->link2))<a href="{!! $blockData->link2 !!}">@endif
                            <img src="{!! $blockData->image2 or '' !!}" class="thumbnail" alt="Image 2" />
                        @if (!empty($blockData->link2))</a>@endif
                    @endif
                </div> <!-- /.cell -->

                <div class="cell small-6 medium-4 large-2" data-scrollreveal>
                    @if (!empty($blockData->image3))
                        @if (!empty($blockData->link3))<a href="{!! $blockData->link3 !!}">@endif
                            <img src="{!! $blockData->image3 or '' !!}" class="thumbnail" alt="Image 3" />
                        @if (!empty($blockData->link3))</a>@endif
                    @endif
                </div> <!-- /.cell -->

                <div class="cell small-6 medium-4 large-2" data-scrollreveal>
                    @if (!empty($blockData->image4))
                        @if (!empty($blockData->link4))<a href="{!! $blockData->link4 !!}">@endif
                            <img src="{!! $blockData->image4 or '' !!}" class="thumbnail" alt="Image 4" />
                        @if (!empty($blockData->link4))</a>@endif
                    @endif
                </div> <!-- /.cell -->

                <div class="cell small-6 medium-4 large-2" data-scrollreveal>
                    @if (!empty($blockData->image5))
                        @if (!empty($blockData->link5))<a href="{!! $blockData->link5 !!}">@endif
                            <img src="{!! $blockData->image5 or '' !!}" class="thumbnail" alt="Image 5" />
                        @if (!empty($blockData->link5))</a>@endif
                    @endif
                </div> <!-- /.cell -->

                <div class="cell small-6 medium-4 large-2" data-scrollreveal>
                    @if (!empty($blockData->image6))
                        @if (!empty($blockData->link6))<a href="{!! $blockData->link6 !!}">@endif
                            <img src="{!! $blockData->image6 or '' !!}" class="thumbnail" alt="Image 6" />
                        @if (!empty($blockData->link6))</a>@endif
                    @endif
                </div> <!-- /.cell -->

            </div> <!-- /.grid -->
        </div> <!-- /.container -->

        <div class="vspace-small-1"></div>
    </div> <!-- /.background -->
</div> <!-- /.pageb-block -->
<!-- /IMAGE ROW BLOCK -->
