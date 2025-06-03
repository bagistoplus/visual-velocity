@php
  $categories = $getCategories();
  $filters = $getFilters();
@endphp

<x-shop::categories.carousel
  :title="''"
  :categories="$categories"
  :src="route('shop.api.categories.index', ['filters' => $getFilters()])"
  :navigation-link="route('shop.home.index')"
  aria-label="{{ trans('shop::app.home.index.categories-carousel') }}"
/>
