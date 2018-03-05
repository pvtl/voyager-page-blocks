@foreach($blocks as $block)
    @if (!empty($block->html))
        @php echo (string)$block->html @endphp
    @elseif (View::exists('voyager-page-blocks::block_templates/' . $block->template))
        @component('voyager-page-blocks::block_templates/' . $block->template, ['blockData' => $block->data])
        @endcomponent
    @else
        <div class="page-block">
            <div class="callout alert">
                <div class="grid-container column text-center">
                    <h2><< !! Warning: Missing Block !! >></h2>
                </div>
            </div>
        </div>
    @endif
@endforeach
