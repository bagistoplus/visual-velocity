<style>
    @if ($theme->settings->default_scheme)
        :root {
            {!! $theme->settings->default_scheme->outputCssVars() !!}
        }
    @endif
    @foreach ($theme->settings->color_schemes as $scheme)
        [{!! $scheme->attributes() !!}] {
            {!! $scheme->outputCssVars() !!}
        }
    @endforeach
</style>
