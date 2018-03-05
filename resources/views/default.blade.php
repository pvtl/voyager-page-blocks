@foreach($blocks as $block)
    @if (!empty($block->html))
        {{ $block->html }}
    @elseif(View::exists('voyager-page-blocks::block_templates/' . $block->template))
        @component('voyager-page-blocks::block_templates/' . $block->template, ['blockData' => $block->data])
        @endcomponent
    @elseif($block->template === 'include' && View::exists('voyager-page-blocks-includes::' . $block->path))
        @component('voyager-page-blocks-includes::' . $block->path, ['blockData' => $block->data]) @endcomponent
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
