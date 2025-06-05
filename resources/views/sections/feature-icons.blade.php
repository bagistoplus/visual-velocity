@php
    $columns = $section->settings->columns ?: 4;
    $iconSize = $section->settings->icon_size ?: 24;
    $features = $getFeatures();

    $gridClass =
        [
            1 => 'md:grid-cols-1',
            2 => 'md:grid-cols-2',
            3 => 'md:grid-cols-3',
            4 => 'md:grid-cols-4',
            5 => 'md:grid-cols-5',
            6 => 'md:grid-cols-6',
        ][$columns] ?? 'md:grid-cols-4';
@endphp
<div class="container mt-20 max-lg:px-8 max-md:mt-10 max-md:px-4">

    <div class="{{ $gridClass }} grid grid-cols-1 gap-6 md:gap-10">
        @foreach ($features as $feature)
            <div class="flex flex-row items-start gap-4 text-left text-sm">

                <div class="flex flex-none items-center justify-center rounded-full border border-primary p-3">
                    @svg($feature['icon'] ?? 'lucide-tag', [
                        'class' => 'text-primary',
                        'style' => "width: {$iconSize}px;",
                        $section->liveUpdate()->style('icon_size', 'width'),
                    ])
                </div>

                <div>
                    <h3 class="mb-1 font-dmserif text-base font-semibold" {{ $feature['liveUpdateTitle'] ?? '' }}>{{ $feature['title'] }}</h3>
                    <p class="text-sm text-on-background/60" {{ $feature['liveUpdateText'] ?? '' }}>{{ $feature['text'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

@visual_design_mode
@pushOnce('scripts')
    <script>
        document.addEventListener('visual:editor:init', function() {
            window.Visual.handleLiveUpdate('{{ $section->type }}', {
                section: {
                    columns: {
                        target: '.grid',
                        handler(el, value) {
                            Array.from(Array(6)).forEach((_, i) => {
                                const cls = `md:grid-cols-${i + 1}`;
                                el.classList.remove(cls);
                            });
                            el.classList.add(`md:grid-cols-${value}`);
                        }
                    },
                }
            });
        });
    </script>
@endpushOnce
@end_visual_design_mode
