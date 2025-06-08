@php
    $slides = $getSlides();
@endphp

<v-slideshow>
    <div class="overflow-hidden">
        <div class="shimmer aspect-[2.743/1] max-h-screen w-screen"></div>
    </div>
</v-slideshow>

@pushOnce('scripts')
    <script type="text/x-template" id="v-slideshow-template">
        @include('shop::sections.slideshow.template')
    </script>

    @include('shop::sections.slideshow.script')
@endpushOnce
