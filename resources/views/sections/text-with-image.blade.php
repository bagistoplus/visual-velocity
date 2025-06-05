@php
    $reverse = $section->settings->image_position === 'right';

    $imageHeightClass = match ($section->settings->image_height) {
        'sm' => 'h-40',
        'md' => 'h-64',
        'lg' => 'h-96',
        default => 'h-auto',
    };

    $imageWidthClass = match ($section->settings->image_width) {
        'sm' => 'md:w-1/3',
        'lg' => 'md:w-2/3',
        default => 'md:w-1/2',
    };

    $contentPositionClass = match ($section->settings->content_position) {
        'top' => 'items-start',
        'bottom' => 'items-end',
        default => 'items-center',
    };

    $contentAlignClass = match ($section->settings->content_align) {
        'center' => 'md:text-center md:items-center',
        'end' => 'md:text-end md:items-end',
        default => 'md:text-start md:items-start',
    };

    $mobileAlignClass = match ($section->settings->content_align_mobile) {
        'center' => 'text-center items-center',
        'end' => 'text-end items-end',
        default => 'text-start items-start',
    };

@endphp

<div class="container py-12 max-lg:px-8 max-md:mt-8 max-sm:mt-7 max-sm:!px-4">
    <div class="{{ $reverse ? 'md:flex-row-reverse' : '' }} {{ $contentPositionClass }} wrapper flex flex-col gap-4 md:flex-row md:gap-6 lg:gap-12"
        {{ $section->liveUpdate()->toggleClass('image_position', 'md:flex-row-reverse') }}
    >
        <div class="{{ $imageWidthClass }} image-wrapper w-full overflow-hidden rounded-2xl border-none">
            @if ($section->settings->image)
                <img
                    src="{{ $section->settings->image }}"
                    alt=""
                    class="{{ $imageHeightClass }} w-full object-cover"
                    {{ $section->liveUpdate()->attr('image', 'src') }}
                />
            @endif
        </div>

        <div class="{{ $mobileAlignClass }} {{ $contentAlignClass }} content flex w-full max-w-md flex-col gap-4 md:mt-0 md:w-1/2 md:gap-5">
            @foreach ($section->blocks as $block)
                @switch($block->type)
                    @case('heading')
                        <h2 class="font-dmserif text-xl text-primary sm:text-2xl md:text-4xl lg:text-6xl lg:leading-tight" {{ $block->liveUpdate()->text('text') }}>
                            {{ $block->settings->text }}
                        </h2>
                    @break

                    @case('body')
                        <div class="text-lg text-on-background/70" {{ $block->liveUpdate()->html('content') }}>
                            {!! $block->settings->content !!}
                        </div>
                    @break

                    @case('button')
                        <a
                            href="{{ $block->settings->url }}"
                            class="rounded-lg bg-primary px-8 py-4 font-semibold text-on-primary hover:bg-primary/90 md:rounded-xl"
                            {{ $block->liveUpdate()->text('text')->attr('url', 'href') }}
                        >
                            {{ $block->settings->text }}
                        </a>
                    @break
                @endswitch
            @endforeach
        </div>
    </div>
</div>

@visual_design_mode
@pushOnce('scripts')
    <script>
        document.addEventListener('visual:editor:init', function() {
            window.Visual.handleLiveUpdate('{{ $section->type }}', {
                section: {
                    image_height: {
                        target: 'img',
                        handler(el, value) {
                            const cls = ({
                                sm: 'h-40',
                                md: 'h-64',
                                lg: 'h-96',
                                auto: 'h-auto',
                            })[value] || 'h-auto';

                            el.classList.remove('h-40', 'h-64', 'h-96', 'h-auto');
                            el.classList.add(cls);
                        }
                    },
                    image_width: {
                        target: '.image-wrapper',
                        handler(el, value) {
                            const cls = ({
                                sm: 'md:w-1/3',
                                lg: 'md:w-2/3',
                                auto: 'md:w-1/2',
                            })[value] || 'md:w-1/2';

                            el.classList.remove('md:w-1/3', 'md:w-2/3', 'md:w-1/2');
                            el.classList.add(cls);
                        }
                    },
                    content_position: {
                        target: '.wrapper',
                        handler(el, value) {
                            const cls = ({
                                top: 'items-start',
                                bottom: 'items-end',
                                center: 'items-center',
                            })[value] || 'items-center';

                            el.classList.remove('items-start', 'items-end', 'items-center');
                            el.classList.add(cls);
                        }
                    },
                    content_align: {
                        target: '.content',
                        handler(el, value) {
                            const cls = ({
                                center: 'md:text-center md:items-center',
                                end: 'md:text-end md:items-end',
                                start: 'md:text-start md:items-start',
                            })[value] || 'md:text-start md:items-start';

                            el.classList.remove('md:text-center', 'md:text-end', 'md:text-start', 'md:items-center', 'md:items-end', 'md:items-start');
                            cls.split(' ').forEach(c => el.classList.add(c));
                        }
                    },
                    content_align_mobile: {
                        target: '.content',
                        handler(el, value) {
                            const cls = ({
                                center: 'text-center items-center',
                                end: 'text-end items-end',
                                start: 'text-start items-start',
                            })[value] || 'text-start items-start';

                            el.classList.remove('text-center', 'text-end', 'text-start', 'items-center', 'items-end', 'items-start');
                            cls.split(' ').forEach(c => el.classList.add(c));
                        }
                    },
                },
            });
        });
    </script>
@endpushOnce
@end_visual_design_mode
