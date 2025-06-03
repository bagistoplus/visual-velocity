<?php

namespace BagistoPlus\VisualVelocity\Sections;

use BagistoPlus\Visual\Sections\BladeSection;
use BagistoPlus\Visual\Sections\Block;
use BagistoPlus\Visual\Settings\Category;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Icon;
use BagistoPlus\Visual\Settings\Number;
use BagistoPlus\Visual\Settings\Product;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Settings\Text;
use Webkul\Shop\Http\Resources\ProductResource;

use function BagistoPlus\VisualVelocity\_t;

class ProductCarousel extends BladeSection
{
    protected static string $view = 'shop::sections.product-carousel';

    public static function name(): string
    {
        return _t('product-carousel.name');
    }

    public static function description(): string
    {
        return _t('product-carousel.description');
    }

    public static function settings(): array
    {
        return [
            Text::make('heading', _t('product-carousel.settings.heading_label'))
                ->default(_t('product-carousel.settings.heading_default')),

            Category::make('category', _t('product-carousel.settings.category_label')),

            Select::make('sort', _t('product-carousel.settings.sort_label'))
                ->options([
                    'name-asc'  => _t('product-carousel.settings.sort.name_asc'),
                    'name-desc'  => _t('product-carousel.settings.sort.name_desc'),
                    'created_at-asc'  => _t('product-carousel.settings.sort.created_at_asc'),
                    'created_at-desc'  => _t('product-carousel.settings.sort.created_at_desc'),
                    'price-asc'  => _t('product-carousel.settings.sort.price_asc'),
                    'price-desc'  => _t('product-carousel.settings.sort.price_desc'),
                ])
                ->default('name-asc'),

            Number::make('limit', _t('product-carousel.settings.limit_label'))
                ->default(12),

            Checkbox::make('filter_new', _t('product-carousel.settings.filter_new_label'))
                ->default(true),

            Checkbox::make('filter_featured', _t('product-carousel.settings.filter_featured_label'))
                ->default(false),

            Icon::make('prev_icon', 'Previous icon'),
            Icon::make('next_icon', 'Next icon'),
        ];
    }

    public static function blocks(): array
    {
        return [
            Block::make('product', _t('product-carousel.blocks.product.name'))
                ->settings([
                    Product::make('product', _t('product-carousel.blocks.product.settings.product_label'))
                ])
        ];
    }

    public function getProducts(): array
    {
        return collect($this->section->blocks)
            ->map(fn($block) => $block->settings->product)
            ->filter()
            ->map(fn($product) => (new ProductResource($product))->resolve())
            ->toArray();
    }

    public function getFilters(): array
    {
        $filters = [];

        if ($this->section->settings->category) {
            $filters['category_id'] = $this->section->settings->category->id;
        }

        if ($this->section->settings->sort) {
            $filters['sort'] = $this->section->settings->sort;
        }

        if ($this->section->settings->name) {
            $filters['name'] = $this->section->settings->name;
        }

        if ($this->section->settings->limit) {
            $filters['limit'] = $this->section->settings->limit;
        }

        if ($this->section->settings->filter_new) {
            $filters['new'] = 1;
        }

        if ($this->section->settings->filter_featured) {
            $filters['featured'] = 1;
        }

        return $filters;
    }
}
