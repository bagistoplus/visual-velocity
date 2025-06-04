@php
  $channel = core()->getCurrentChannel();
@endphp

<!-- SEO Meta Content -->
@push('meta')
  <meta name="title" content="{{ $channel->home_seo['meta_title'] ?? '' }}" />

  <meta name="description" content="{{ $channel->home_seo['meta_description'] ?? '' }}" />

  <meta name="keywords" content="{{ $channel->home_seo['meta_keywords'] ?? '' }}" />
@endPush

<x-shop::layouts>
  <!-- Page Title -->
  <x-slot:title>
    {{ $channel->home_seo['meta_title'] ?? '' }}
  </x-slot>

  @includeIf('shop::templates.index')
</x-shop::layouts>
