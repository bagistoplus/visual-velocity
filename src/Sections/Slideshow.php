<?php

namespace BagistoPlus\VisualVelocity\Sections;

use Illuminate\Support\Str;
use BagistoPlus\Visual\Settings\Link;
use BagistoPlus\Visual\Settings\Text;
use BagistoPlus\Visual\Sections\Block;

use BagistoPlus\Visual\Settings\Image;
use BagistoPlus\Visual\Settings\Number;
use function BagistoPlus\VisualVelocity\_t;
use BagistoPlus\Visual\Sections\BladeSection;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Settings\Support\ImageValue;
use Webkul\Theme\Repositories\ThemeCustomizationRepository;

class Slideshow extends BladeSection
{
    protected static string $view = 'shop::sections.slideshow.index';

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
                    Image::make('image', _t('slideshow.blocks.slide.settings.image_label'))
                        ->default(asset('themes/shop/visual-velocity/images/hero-image.jpg'))
                        ->info(_t('slideshow.blocks.slide.settings.image_info')),

                    Text::make('heading', _t('slideshow.blocks.slide.settings.heading_label')),
                    Select::make('heading_size', _t('slideshow.blocks.slide.settings.heading_size_label'))
                        ->options([
                            'small'    => _t('slideshow.blocks.slide.settings.size_small'),
                            'medium'   => _t('slideshow.blocks.slide.settings.size_medium'),
                            'large'    => _t('slideshow.blocks.slide.settings.size_large'),
                            'xlarge'   => _t('slideshow.blocks.slide.settings.size_xlarge'),
                            '2xlarge'  => _t('slideshow.blocks.slide.settings.size_2xlarge'),
                        ])
                        ->default('2xlarge'),

                    Text::make('subheading', _t('slideshow.blocks.slide.settings.subheading_label')),
                    Select::make('subheading_size', _t('slideshow.blocks.slide.settings.subheading_size_label'))
                        ->options([
                            'small'    => _t('slideshow.blocks.slide.settings.size_small'),
                            'medium'   => _t('slideshow.blocks.slide.settings.size_medium'),
                            'large'    => _t('slideshow.blocks.slide.settings.size_large'),
                            'xlarge'   => _t('slideshow.blocks.slide.settings.size_xlarge'),
                            '2xlarge'  => _t('slideshow.blocks.slide.settings.size_2xlarge'),
                        ])
                        ->default('large'),

                    Text::make('button_text', _t('slideshow.blocks.slide.settings.button_text_label')),
                    Link::make('button_link', _t('slideshow.blocks.slide.settings.button_link_label'))
                        ->default('/'),

                    Select::make('content_placement', _t('slideshow.blocks.slide.settings.content_placement_label'))
                        ->options([
                            'center' => _t('slideshow.blocks.slide.settings.placement_center'),
                            'start'   => _t('slideshow.blocks.slide.settings.placement_left'),
                            'end'  => _t('slideshow.blocks.slide.settings.placement_right'),
                        ])
                        ->default('center')
                ]),
        ];
    }

    public function getSlides(): array
    {
        $blocks = collect($this->section->blocks);

        if ($blocks->isNotEmpty()) {
            return $blocks->map(function ($block) {
                return [
                    'id' => $block->id,
                    'title' => $block->settings->heading,
                    'heading' => $block->settings->heading,
                    'headingSize' => $block->settings->heading_size,
                    'subheading' => $block->settings->subheading,
                    'subheadingSize' => $block->settings->subheading_size,
                    'buttonLink' => $block->settings->button_link,
                    'buttonText' => $block->settings->button_text,
                    'link' => $block->settings->button_link,
                    'image' => $block->settings->image->__toString(),
                    'srcset' => $block->settings->image->srcset(),
                    'liveUpdate' => [
                        'heading' => $block->liveUpdate()->text('heading')->toHtml(),
                        'subheading' => $block->liveUpdate()->text('subheading')->toHtml(),
                        'button' => $block->liveUpdate()->text('button_text')->attr('button_link', 'href')->toHtml(),
                    ],
                    'content_placement' => $block->settings->content_placement
                ];
            })->toArray();
        }

        $themeCustomizationRepository = app(ThemeCustomizationRepository::class);
        $imageCarousel = $themeCustomizationRepository->orderBy('sort_order')
            ->findOneWhere([
                'status' => 1,
                'channel_id' => core()->getCurrentChannel()->id,
                'theme_code' => 'default'
            ]);

        if ($imageCarousel) {
            return collect($imageCarousel->options['images'])
                ->map(function ($slide) {
                    $path = Str::after($slide['image'], 'storage/');
                    $image = new ImageValue(
                        path: $path,
                        url: url($slide['image']),
                        name: basename($path),
                    );

                    return [
                        'title' => $slide['title'],
                        'link' => $slide['link'],
                        'image' => $image->__toString(),
                        'srcset' => $image->srcset()
                    ];
                })->toArray();
        }

        return [];
    }
}
