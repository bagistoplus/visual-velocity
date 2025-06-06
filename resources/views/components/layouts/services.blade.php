{!! view_render_event('bagisto.shop.layout.features.before') !!}

<!--
    The ThemeCustomizationRepository repository is injected directly here because there is no way
    to retrieve it from the view composer, as this is an anonymous component.
-->
@inject('themeCustomizationRepository', 'Webkul\Theme\Repositories\ThemeCustomizationRepository')

@php
    $channel = core()->getCurrentChannel();

    $customization = $themeCustomizationRepository->findOneWhere([
        'type' => 'services_content',
        'status' => 1,
        'theme_code' => $channel->theme,
        'channel_id' => $channel->id,
    ]);
@endphp

<!-- Features -->
@if ($customization)
    <div class="container mt-20 max-lg:px-8 max-md:mt-10 max-md:px-4">
        <div class="max-md:max-y-6 flex justify-center gap-6 max-lg:flex-wrap max-md:grid max-md:grid-cols-2 max-md:gap-x-2.5 max-md:text-center">
            @foreach ($customization->options['services'] as $service)
                <div class="flex items-center gap-5 bg-background max-md:grid max-md:gap-2.5 max-sm:gap-1 max-sm:px-2">
                    <span
                        class="{{ $service['service_icon'] }} flex h-[60px] w-[60px] items-center justify-center rounded-full border border-on-background bg-background p-2.5 text-4xl text-navyBlue max-md:m-auto max-md:h-16 max-md:w-16 max-sm:h-10 max-sm:w-10 max-sm:text-2xl"
                        role="presentation"
                    ></span>

                    <div class="max-lg:grid max-lg:justify-center">
                        <!-- Service Title -->
                        <p class="font-dmserif text-base font-medium max-md:text-xl max-sm:text-sm">{{ $service['title'] }}</p>

                        <!-- Service Description -->
                        <p class="mt-2.5 max-w-[217px] text-sm font-medium text-on-background/70 max-md:mt-0 max-md:text-base max-sm:text-xs">
                            {{ $service['description'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

{!! view_render_event('bagisto.shop.layout.features.after') !!}
