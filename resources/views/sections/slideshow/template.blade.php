@php
    $headingSizes = [
        'small' => 'text-sm sm:text-base md:text-lg lg:text-2xl xl:text-4xl',
        'medium' => 'text-base sm:text-lg md:text-2xl lg:text-4xl xl:text-5xl',
        'large' => 'text-lg sm:text-2xl md:text-4xl lg:text-5xl xl:text-6xl',
        'xlarge' => 'text-2xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl',
        '2xlarge' => 'text-4xl sm:text-5xl md:text-7xl lg:text-8xl xl:text-[7rem]',
    ];

    $placementClass = [
        'center' => 'items-center justify-center text-center',
        'start' => 'items-start justify-start text-start',
        'end' => 'items-end justify-end text-end',
    ];
@endphp

<div class="relative m-auto flex w-full overflow-hidden bg-background text-on-background" {{ $section->settings->scheme?->attributes() }}>
    <!-- Slider -->
    <div ref="sliderContainer" class="inline-flex translate-x-0 cursor-pointer transition-transform duration-700 ease-out will-change-transform">
        @foreach ($slides as $slide)
            <div
                class="slide relative max-h-screen w-screen bg-cover bg-no-repeat"
                @isset($slide['id']) data-slide-id="{{ $slide['id'] }}" @endisset
                @click="visitLink('{{ $slide['link'] }}')"
            >
                <x-shop::media.images.lazy
                    class="aspect-[2.743/1] max-h-full w-full max-w-full select-none transition-transform duration-300 ease-in-out"
                    ::lazy="false"
                    src="{{ $slide['image'] }}"
                    srcset=""
                    srcset="{{ $slide['srcset'] }}"
                    alt="{{ $slide['heading'] ?? $slide['title'] }}"
                    tabindex="0"
                    fetchpriority="high"
                />

                <div class="{{ $placementClass[$slide['content_placement'] ?? 'start'] }} absolute inset-0 flex items-center px-6 sm:px-7 md:px-10 lg:px-16">
                    <div class="space-y-1 md:space-y-2 lg:space-y-4">
                        @if (!empty($slide['heading']))
                            <h2 class="{{ $headingSizes[$slide['headingSize']] }} font-heading font-bold text-primary" {!! isset($slide['liveUpdate']) ? $slide['liveUpdate']['heading'] : '' !!}>
                                {{ $slide['heading'] }}
                            </h2>
                        @endif

                        @if (!empty($slide['subheading']))
                            <p class="{{ $headingSizes[$slide['subheadingSize']] }} font-heading font-bold tracking-wide text-primary" {!! isset($slide['liveUpdate']) ? $slide['liveUpdate']['subheading'] : '' !!}>
                                {{ $slide['subheading'] }}
                            </p>
                        @endif

                        @if (!empty($slide['buttonText']))
                            <a
                                href="{{ $slide['buttonLink'] ?? '#' }}"
                                class="inline-block rounded-lg bg-primary px-3 py-1.5 text-[0.5rem] text-on-primary sm:px-4 sm:py-2 sm:text-xs md:px-6 md:py-2.5 md:text-sm lg:px-8 lg:py-3 lg:text-lg"
                                {!! isset($slide['liveUpdate']) ? $slide['liveUpdate']['button'] : '' !!}
                            >
                                {{ $slide['buttonText'] }}
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Navigation -->
    <span
        v-if="slides?.length >= 2"
        class="icon-arrow-left absolute left-2.5 top-1/2 -mt-[22px] hidden w-auto rounded-full bg-black/80 p-3 text-2xl font-bold text-white opacity-30 transition-all md:inline-block"
        :class="{
            'cursor-not-allowed': direction == 'ltr' && currentIndex == 0,
            'cursor-pointer hover:opacity-100': direction == 'ltr' ? currentIndex > 0 : currentIndex <= 0
        }"
        role="button"
        aria-label="@lang('shop::components.carousel.previous')"
        tabindex="0"
        @click="navigate('prev')"
    >
    </span>

    <span
        v-if="slides.length >= 2"
        class="icon-arrow-right absolute right-2.5 top-1/2 -mt-[22px] hidden w-auto rounded-full bg-black/80 p-3 text-2xl font-bold text-white opacity-30 transition-all md:inline-block"
        :class="{
            'cursor-not-allowed': direction == 'rtl' && currentIndex == 0,
            'cursor-pointer hover:opacity-100': direction == 'rtl' ? currentIndex < 0 : currentIndex >= 0
        }"
        role="button"
        aria-label="@lang('shop::components.carousel.next')"
        tabindex="0"
        @click="navigate('next')"
    >
    </span>

    <!-- Pagination -->
    <div class="absolute bottom-5 left-0 flex w-full justify-center max-md:bottom-3.5 max-sm:bottom-2.5">
        <div
            v-for="(image, index) in slides"
            class="mx-1 h-3 w-3 cursor-pointer rounded-full max-md:h-2 max-md:w-2 max-sm:h-1.5 max-sm:w-1.5"
            :class="{
                'bg-primary': index === Math.abs(currentIndex),
                'opacity-30 bg-gray-500': index !== Math.abs(currentIndex)
            }"
            role="button"
            tabindex="0"
            @click="navigateByPagination(index)"
        >
        </div>
    </div>
</div>
