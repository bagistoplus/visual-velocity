<?php

namespace BagistoPlus\VisualVelocity\Sections;

use BagistoPlus\Visual\Settings\Link;
use BagistoPlus\Visual\Settings\Text;
use BagistoPlus\Visual\Sections\Block;
use BagistoPlus\Visual\Settings\Image;

use function BagistoPlus\VisualVelocity\_t;
use BagistoPlus\Visual\Sections\BladeSection;
use Webkul\Theme\Repositories\ThemeCustomizationRepository;

class Slideshow extends BladeSection
{
    protected static string $view = 'shop::sections.slideshow';

    public static function settings(): array
    {
        // section settings
        return [];
    }

    public static function blocks(): array
    {
        return [
            Block::make('slide', _t('slideshow.blocks.slide.name'))
                ->settings([
                    Text::make('title', _t('slideshow.blocks.slide.settings.title_label')),
                    Link::make('link', _t('slideshow.blocks.slide.settings.link_label'))
                        ->default('/'),
                    Image::make('image', _t('slideshow.blocks.slide.settings.image_label'))
                        ->default(asset('themes/shop/visual-velocity/images/hero-image.webp'))
                        ->info(_t('slideshow.blocks.slide.settings.image_info')),
                ]),
        ];
    }

    public function getSlides(): array
    {
        $blocks = collect($this->section->blocks);

        if ($blocks->isNotEmpty()) {
            return [
                'images' => $blocks->map(function ($block) {
                    return [
                        'title' => $block->settings->title,
                        'link' => $block->settings->link,
                        'image' => $block->settings->image->__toString(),
                    ];
                })->toArray()
            ];
        }

        $themeCustomizationRepository = app(ThemeCustomizationRepository::class);
        $imageCarousel = $themeCustomizationRepository->orderBy('sort_order')
            ->findOneWhere([
                'status' => 1,
                'channel_id' => core()->getCurrentChannel()->id,
                'theme_code' => 'default'
            ]);

        if ($imageCarousel) {
            return $imageCarousel->options;
        }

        return [];
    }
}
