@php
  $filters = $getFilters();
  $products = $getProducts();
@endphp

<x-shop::products.carousel
  :prev-icon="$section->settings->prev_icon"
  :title="$section->settings->heading"
  :src="route('shop.api.products.index', ['filters' => $filters])"
  :navigation-link="route('shop.search.index', ['filters' => $filters])"
  :selected-products="$products"
  :next-icon="$section->settings->next_icon"
  aria-label="{{ trans('shop::app.home.index.product-carousel') }}"
  :live-update="[
      'title' => $section->liveUpdate()->text('heading')->toHtml(),
  ]"
/>
