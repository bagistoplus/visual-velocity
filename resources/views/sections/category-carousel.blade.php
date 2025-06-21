@php
    $categories = $getCategories();
    $filters = $getFilters();
@endphp

<div {{ $section->settings->scheme?->attributes() }} class="bg-background text-on-background">
    <x-shop::categories.carousel
        :title="''"
        :categories="$categories"
        :src="route('shop.api.categories.index', $filters)"
        :navigation-link="route('shop.home.index')"
        aria-label="{{ trans('shop::app.home.index.categories-carousel') }}"
    />
</div>
