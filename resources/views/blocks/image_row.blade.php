<!-- IMAGE ROW BLOCK -->
<div class="page-block @if (in_array($blockData->spaces, [0, 2])) page-block-space-bottom @endif @if (in_array($blockData->spaces, [1, 2])) page-block-space-top @endif">
    <div class="border-bottom image-row-block">
        <div class="@if (!empty($blockData->title)) vspace-small-1 @else vspace-small-2 @endif"></div>

        <div class="grid-container text-center overflow-hidden">
            @if (!empty($blockData->title)) <h2>{{ $blockData->title }}</h2> @endif
            @if (!empty($blockData->sub_title)) <p class="lead">{{ $blockData->sub_title }}</p> @endif
            <div class="vspace-1"></div>

            <div class="grid-x grid-padding-x small-up-2 medium-up-6">
                <div
                    class="cell"
                    @if (!empty($blockData->animate)) data-scrollreveal @endif
                >
                    @if (!empty($blockData->image_1))
                        @if (!empty($blockData->link_1))<a href="{{ $blockData->link_1 }}">@endif
                            <img src="{{ imageUrl($blockData->image_1, 170, 170) }}" class="thumbnail" alt="Image 1">
                        @if (!empty($blockData->link_1))</a>@endif
                    @endif
                </div> <!-- /.cell -->

                <div
                    class="cell"
                    @if (!empty($blockData->animate)) data-scrollreveal @endif
                >
                    @if (!empty($blockData->image_2))
                        @if (!empty($blockData->link_2))<a href="{{ $blockData->link_2 }}">@endif
                            <img src="{{ imageUrl($blockData->image_2, 170, 170) }}" class="thumbnail" alt="Image 2">
                        @if (!empty($blockData->link_2))</a>@endif
                    @endif
                </div> <!-- /.cell -->

                <div class="cell" data-scrollreveal>
                    @if (!empty($blockData->image_3))
                        @if (!empty($blockData->link_3))<a href="{{ $blockData->link_3 }}">@endif
                            <img src="{{ imageUrl($blockData->image_3, 170, 170) }}" class="thumbnail" alt="Image 3">
                        @if (!empty($blockData->link_3))</a>@endif
                    @endif
                </div> <!-- /.cell -->

                <div
                    class="cell"
                    @if (!empty($blockData->animate)) data-scrollreveal @endif
                >
                    @if (!empty($blockData->image_4))
                        @if (!empty($blockData->link_4))<a href="{{ $blockData->link_4 }}">@endif
                            <img src="{{ imageUrl($blockData->image_4, 170, 170) }}" class="thumbnail" alt="Image 4">
                        @if (!empty($blockData->link_4))</a>@endif
                    @endif
                </div> <!-- /.cell -->

                <div
                    class="cell"
                    @if (!empty($blockData->animate)) data-scrollreveal @endif
                >
                    @if (!empty($blockData->image_5))
                        @if (!empty($blockData->link_5))<a href="{{ $blockData->link_5 }}">@endif
                            <img src="{{ imageUrl($blockData->image_5, 170, 170) }}" class="thumbnail" alt="Image 5">
                        @if (!empty($blockData->link_5))</a>@endif
                    @endif
                </div> <!-- /.cell -->

                <div
                    class="cell"
                    @if (!empty($blockData->animate)) data-scrollreveal @endif
                >
                    @if (!empty($blockData->image_6))
                        @if (!empty($blockData->link_6))<a href="{{ $blockData->link_6 }}">@endif
                            <img src="{{ imageUrl($blockData->image_6, 170, 170) }}" class="thumbnail" alt="Image 6">
                        @if (!empty($blockData->link_6))</a>@endif
                    @endif
                </div> <!-- /.cell -->

            </div> <!-- /.grid -->
        </div> <!-- /.container -->

        <div class="vspace-small-1"></div>
    </div> <!-- /.background -->
</div> <!-- /.pageb-block -->
<!-- /IMAGE ROW BLOCK -->
