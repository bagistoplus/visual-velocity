{{-- blade-formatter-disable --}}
@style
    :root {
        --default-font-family: '{{ $theme->settings->default_font }}';
        --heading-font-family: '{{ $theme->settings->heading_font }}';
    }

    @foreach ($theme->settings->color_schemes as $scheme)
        @if($scheme->id === $theme->settings->default_scheme->id)
            :root,
        @endif
        [{!! $scheme->attributes() !!}] {
            @foreach($scheme->tokens as $name => $value)
                @php
                    $color = \matthieumastadenis\couleur\ColorFactory::newRgb($value);
                @endphp

                --color-{{ $name }}: {{ $color->red }} {{ $color->green }} {{ $color->blue }};
                @if(!str_starts_with($name, 'on-'))
                    @php
                        $shades = \BagistoPlus\Visual\View\TailwindPaletteGenerator::generate($color);
                    @endphp
                    @foreach($shades as $stop => $color)
                        --color-{{ $name }}-{{ $stop }}: {{ $color->red }} {{ $color->green }} {{ $color->blue }};
                    @endforeach
                @endif
            @endforeach
        }
    @endforeach
@endstyle
{{-- blade-formatter-enable --}}
