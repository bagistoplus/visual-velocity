<p class="price-label text-sm text-on-background/70 max-sm:text-xs">
    @lang('shop::app.products.prices.configurable.as-low-as')
</p>

<p class="regular-price text-lg font-semibold text-on-background/70 line-through"></p>

<p class="final-price font-semibold">
    {{ $prices['regular']['formatted_price'] }}
</p>
