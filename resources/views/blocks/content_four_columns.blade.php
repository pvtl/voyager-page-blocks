<!-- FOUR COLUMN BLOCK -->
<div class="page-block @if (in_array($blockData->spaces, [0, 2])) page-block-space-bottom @endif @if (in_array($blockData->spaces, [1, 2])) page-block-space-top @endif">
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-3" @if (!empty($blockData->animate)) data-scrollreveal @endif>
                {!! $blockData->html_content_1 !!}
            </div> <!-- /.cell -->

            <div class="cell small-12 medium-3" @if (!empty($blockData->animate)) data-scrollreveal @endif>
                {!! $blockData->html_content_2 !!}
            </div> <!-- /.cell -->

            <div class="cell small-12 medium-3" @if (!empty($blockData->animate)) data-scrollreveal @endif>
                {!! $blockData->html_content_3 !!}
            </div> <!-- /.cell -->

            <div class="cell small-12 medium-3" @if (!empty($blockData->animate)) data-scrollreveal @endif>
                {!! $blockData->html_content_4 !!}
            </div> <!-- /.cell -->
        </div> <!-- /.grid -->
    </div> <!-- /.container -->
</div> <!-- /.page-block -->
<!-- /FOUR COLUMN BLOCK -->