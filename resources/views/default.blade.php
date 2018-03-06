@foreach($blocks as $block)
    @if (!empty($block->html))
        @php echo (string)$block->html @endphp
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
