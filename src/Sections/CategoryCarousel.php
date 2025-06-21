<?php

namespace BagistoPlus\VisualVelocity\Sections;

use BagistoPlus\Visual\Sections\BladeSection;
use BagistoPlus\Visual\Sections\Block;
use BagistoPlus\Visual\Settings\Category;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Number;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Settings\Text;
use Webkul\Shop\Http\Resources\CategoryResource;

use function BagistoPlus\VisualVelocity\_t;

class CategoryCarousel extends BladeSection
{
    protected static string $view = 'shop::sections.category-carousel';

    public static function name(): string
    {
        return _t('category-carousel.name');
    }

    public static function description(): string
    {
        return _t('category-carousel.description');
    }

    public static function settings(): array
    {
        return [
            Category::make('parent', _t('category-carousel.settings.parent_label')),

            Select::make('sort', _t('category-carousel.settings.sort_label'))
                ->options([
                    'asc'  => _t('category-carousel.settings.sort_asc'),
                    'desc' => _t('category-carousel.settings.sort_desc'),
                ])
                ->default('asc'),

            Number::make('limit', _t('category-carousel.settings.limit_label'))
                ->min(1)->max(20)->step(1)->default(8),

            Text::make('name', _t('category-carousel.settings.name_label')),

            Checkbox::make('status', _t('category-carousel.settings.status_label'))
                ->default(true),

            ColorScheme::make('scheme', _t('common.scheme_label'))
                ->info(_t('common.scheme_info'))
        ];
    }

    public static function blocks(): array
    {
        return [
            Block::make('category', _t('category-carousel.blocks.category.label'))
                ->settings([
                    Category::make('category', _t('category-carousel.blocks.category.settings.category_label')),
                ]),
        ];
    }

    public function getCategories(): array
    {
        return collect($this->section->blocks)
            ->map(fn($block) => $block->settings->category)
            ->filter()
            ->map(fn($category) => (new CategoryResource($category))->resolve())
            ->toArray();
    }

    public function getFilters(): array
    {
        $filters = [];

        if ($this->section->settings->parent) {
            $filters['parent_id'] = $this->section->settings->parent->id;
        }

        if ($this->section->settings->name) {
            $filters['name'] = $this->section->settings->name;
        }

        $filters['status'] = $this->section->settings->status ? 1 : 0;

        if ($this->section->settings->sort) {
            $filters['sort'] = $this->section->settings->sort;
        }

        if ($this->section->settings->limit) {
            $filters['limit'] = $this->section->settings->limit;
        }

        return $filters;
    }
}
