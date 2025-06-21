<div class="overflow-hidden bg-background py-4 text-on-background md:py-7 lg:py-10" {{ $section->settings->scheme?->attributes() }}>
    @if ($section->settings->heading)
        <h2 class="mx-auto mb-6 w-full max-w-2xl px-4 text-center font-dmserif text-3xl leading-snug text-primary sm:px-6 sm:text-4xl md:text-5xl md:leading-normal lg:mb-16 lg:text-7xl lg:leading-tight"
            {{ $section->liveUpdate()->text('heading') }}
        >
            {{ $section->settings->heading }}
        </h2>
    @endif

    @php
        $columnsDesktop = $section->settings->columns_desktop ?? 3;
        $columnsMobile = $section->settings->columns_mobile ?? 1;
        $imageRatio = match ($section->settings->image_ratio) {
            'portrait' => 'aspect-[3/4]',
            'landscape' => 'aspect-[4/3]',
            default => 'aspect-square',
        };

        $verticalAlign = match ($section->settings->text_alignment_vertical ?? 'bottom') {
            'top' => 'items-start',
            'center' => 'items-center',
            'bottom' => 'items-end',
        };

        $horizontalAlign = match ($section->settings->text_alignment_horizontal ?? 'center') {
            'start' => 'justify-start',
            'end' => 'justify-end',
            default => 'justify-center',
        };

        $mobileGridClass = match ($columnsMobile) {
            1 => 'grid-cols-1',
            2 => 'grid-cols-2',
            default => 'grid-cols-2',
        };

        $desktopGridClass = match ($columnsDesktop) {
            1 => 'md:grid-cols-1',
            2 => 'md:grid-cols-2',
            3 => 'md:grid-cols-3',
            4 => 'md:grid-cols-4',
            5 => 'md:grid-cols-5',
            6 => 'md:grid-cols-6',
            default => 'md:grid-cols-3',
        };
    @endphp

    <div class="{{ $mobileGridClass }} {{ $desktopGridClass }} mx-auto grid w-full max-w-7xl gap-4 px-4 md:gap-6 lg:gap-8">
        @foreach ($section->blocks as $block)
            <a href="{{ $block->settings->link ?? '#' }}" class="group relative block">
                <div class="{{ $imageRatio }} w-full overflow-hidden rounded-3xl bg-surface">
                    @if ($block->settings->image)
                        <img
                            src="{{ $block->settings->image }}"
                            alt="{{ $block->settings->title }}"
                            class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                            {{ $block->liveUpdate()->attr('image', 'src')->attr('title', 'alt') }}
                        />
                    @else
                        <div class="flex h-full w-full items-center justify-center text-sm text-gray-400">Image</div>
                    @endif
                </div>
                <div class="{{ $verticalAlign }} {{ $horizontalAlign }} absolute inset-0 flex p-4">
                    <span class="text-center font-dmserif text-lg font-medium text-primary md:text-xl lg:text-3xl" {{ $block->liveUpdate()->text('title') }}>
                        {{ $block->settings->title }}
                    </span>
                </div>
            </a>
        @endforeach
    </div>
</div>
