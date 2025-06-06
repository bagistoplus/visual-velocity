@props([
    'hasHeader' => true,
    'hasFeature' => true,
    'hasFooter' => true,
])

<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">

    <head>

        {!! view_render_event('bagisto.shop.layout.head.before') !!}

        <title>{{ $title ?? '' }}</title>

        <meta charset="UTF-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="content-language" content="{{ app()->getLocale() }}">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="base-url" content="{{ url()->to('/') }}">
        <meta name="currency" content="{{ core()->getCurrentCurrency()->toJson() }}">

        @stack('meta')

        <link
            rel="icon"
            sizes="16x16"
            href="{{ core()->getCurrentChannel()->favicon_url ?? bagisto_asset('images/favicon.ico') }}"
        />

        @includeIf('shop::partials.tokens')

        @bagistoVite(['resources/assets/css/shop.css', 'resources/assets/js/shop.js'])

        @if ($theme->settings->default_font)
            {{ $theme->settings->default_font->toHtml() }}
        @endif

        @if ($theme->settings->heading_font)
            {{ $theme->settings->heading_font->toHtml() }}
        @endif

        @stack('styles')

        <style>
            {!! core()->getConfigData('general.content.custom_scripts.custom_css') !!}
        </style>

        @if (core()->getConfigData('general.content.speculation_rules.enabled'))
            <script type="speculationrules">
                @json(core()->getSpeculationRules(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
            </script>
        @endif

        {!! view_render_event('bagisto.shop.layout.head.after') !!}

    </head>

    <body class="bg-background text-on-background">
        {!! view_render_event('bagisto.shop.layout.body.before') !!}

        <a href="#main" class="skip-to-main-content-link">
            Skip to main content
        </a>

        <div id="app">
            <!-- Page Header Blade Component -->
            @if ($hasHeader)
                <visual:section name="visual-velocity::top-bar" />
                <visual:section name="visual-velocity::header" />
                <visual:section name="visual-velocity::mobile-header" />
            @endif

            @if (core()->getConfigData('general.gdpr.settings.enabled') && core()->getConfigData('general.gdpr.cookie.enabled'))
                <x-shop::layouts.cookie />
            @endif

            {!! view_render_event('bagisto.shop.layout.content.before') !!}

            <!-- Page Content Blade Component -->
            <main id="main">
                <x-visual::layout-content>
                    {{ $slot }}
                </x-visual::layout-content>
            </main>

            {!! view_render_event('bagisto.shop.layout.content.after') !!}

            <!-- Page Services Blade Component -->
            @if ($hasFeature)
                <visual:section name="visual-velocity::feature-icons" />
            @endif

            <!-- Page Footer Blade Component -->
            @if ($hasFooter)
                <visual:section name="visual-velocity::footer" />
            @endif

            <!-- Flash Message Blade Component -->
            <x-shop::flash-group />

            <!-- Confirm Modal Blade Component -->
            <x-shop::modal.confirm />
        </div>

        {!! view_render_event('bagisto.shop.layout.body.after') !!}

        @stack('scripts')

        {!! view_render_event('bagisto.shop.layout.vue-app-mount.before') !!}
        <script>
            /**
             * Load event, the purpose of using the event is to mount the application
             * after all of our `Vue` components which is present in blade file have
             * been registered in the app. No matter what `app.mount()` should be
             * called in the last.
             */
            window.addEventListener("load", function(event) {
                window.setupApp();
            });
        </script>

        {!! view_render_event('bagisto.shop.layout.vue-app-mount.after') !!}

        <script type="text/javascript">
            {!! core()->getConfigData('general.content.custom_scripts.custom_javascript') !!}
        </script>
    </body>

</html>
