@php
    $links = $getLinks();
@endphp

<div class="mt-9 bg-secondary/80 text-on-secondary max-sm:mt-10">
    <div class="flex justify-between gap-x-6 gap-y-8 p-[60px] max-1060:flex-col-reverse max-md:gap-5 max-md:p-8 max-sm:px-4 max-sm:py-5">
        <!-- For Desktop View -->
        <div class="flex flex-wrap items-start gap-24 max-1180:gap-6 max-1060:hidden">
            @foreach ($links as $linksGroup)
                <ul class="grid gap-5 text-sm">
                    @foreach ($linksGroup['links'] as $link)
                        <li>
                            <a href="{{ $link['url'] }}">
                                {{ $link['text'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>

        <!-- For Mobile view -->
        <x-shop::accordion :is-active="false" class="hidden !w-full rounded-xl !border-2 !border-secondary max-1060:block max-sm:rounded-lg">
            <x-slot:header class="rounded-t-lg bg-secondary/90 font-medium max-md:p-2.5 max-sm:px-3 max-sm:py-2 max-sm:text-sm">
                @lang('shop::app.components.layouts.footer.footer-content')
            </x-slot>

            <x-slot:content class="flex justify-between !bg-transparent !p-4">
                @foreach ($links as $linksGroup)
                    <ul class="grid gap-5 text-sm">
                        @foreach ($linksGroup['links'] as $link)
                            <li>
                                <a href="{{ $link['url'] }}" class="text-sm font-medium max-sm:text-xs">
                                    {{ $link['text'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </x-slot>
        </x-shop::accordion>

        {!! view_render_event('bagisto.shop.layout.footer.newsletter_subscription.before') !!}

        <!-- News Letter subscription -->
        @if (core()->getConfigData('customer.settings.newsletter.subscription'))
            <div class="grid gap-2.5">
                <p
                    class="max-w-[288px] text-3xl italic leading-[45px] text-primary max-md:text-2xl max-sm:text-lg"
                    role="heading"
                    aria-level="2"
                >
                    @lang('shop::app.components.layouts.footer.newsletter-text')
                </p>

                <p class="text-xs">
                    @lang('shop::app.components.layouts.footer.subscribe-stay-touch')
                </p>

                <div>
                    <x-shop::form :action="route('shop.subscription.store')" class="mt-2.5 rounded max-sm:mt-0">
                        <div class="relative w-full">
                            <x-shop::form.control-group.control
                                type="email"
                                class="block w-[420px] max-w-full rounded-xl border-2 border-secondary bg-secondary/50 px-5 py-4 text-base max-1060:w-full max-md:p-3.5 max-sm:mb-0 max-sm:rounded-lg max-sm:border-2 max-sm:p-2 max-sm:text-sm"
                                name="email"
                                rules="required|email"
                                label="Email"
                                :aria-label="trans('shop::app.components.layouts.footer.email')"
                                placeholder="email@example.com"
                            />

                            <x-shop::form.control-group.error control-name="email" />

                            <button type="submit"
                                class="absolute top-1.5 flex w-max items-center rounded-xl bg-background px-7 py-2.5 font-medium hover:bg-surface max-md:top-1 max-md:px-5 max-md:text-xs max-sm:mt-0 max-sm:rounded-lg max-sm:px-4 max-sm:py-2 ltr:right-2 rtl:left-2"
                            >
                                @lang('shop::app.components.layouts.footer.subscribe')
                            </button>
                        </div>
                    </x-shop::form>
                </div>
            </div>
        @endif

        {!! view_render_event('bagisto.shop.layout.footer.newsletter_subscription.after') !!}
    </div>

    <div class="flex justify-between bg-secondary px-[60px] py-3.5 max-md:justify-center max-sm:px-5">
        {!! view_render_event('bagisto.shop.layout.footer.footer_text.before') !!}

        <div class="text-sm text-on-secondary/90 max-md:text-center" {{ $section->liveUpdate()->html('copyright') }}>
            {!! $section->settings->copyright !!}
        </div>

        {!! view_render_event('bagisto.shop.layout.footer.footer_text.after') !!}
    </div>
</div>

{!! view_render_event('bagisto.shop.layout.footer.after') !!}
