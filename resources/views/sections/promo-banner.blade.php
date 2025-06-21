<h1 {{ $section->settings->scheme?->attributes() }}>
    @if ($section->settings->link)
        <a class="font-dmserif" href="{{ $section->settings->link ?? '/' }}"{{ $section->liveUpdate()->text('text')->attr('link', 'href') }}>
            {{ $section->settings->text ?? '' }}
        </a>
    @else
        <span class="font-dmserif" {{ $section->liveUpdate()->text('text') }}>
            {{ $section->settings->text }}
        </span>
    @endif
</h1>
