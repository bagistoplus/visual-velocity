<?php

namespace BagistoPlus\VisualVelocity\Sections;

use BagistoPlus\Visual\Sections\BladeSection;
use BagistoPlus\Visual\Sections\Block;
use BagistoPlus\Visual\Settings;

use function BagistoPlus\VisualVelocity\_t;

class CollectionTiles extends BladeSection
{
    protected static string $view = 'shop::sections.collection-tiles';

    public static function name(): string
    {
        return _t('collection-tiles.name');
    }

    public static function description(): string
    {
        return _t('collection-tiles.description');
    }

    public static function settings(): array
    {
        return [
            Settings\Text::make('heading', _t('collection-tiles.settings.heading_label')),

            Settings\Range::make('columns_desktop', _t('collection-tiles.settings.columns_desktop_label'))
                ->min(2)->max(6)->step(1)->default(3),

            Settings\Range::make('columns_mobile', _t('collection-tiles.settings.columns_mobile_label'))
                ->min(1)->max(2)->step(1)->default(2),

            Settings\Select::make('image_ratio', _t('collection-tiles.settings.image_ratio_label'))
                ->options([
                    'square'    => _t('collection-tiles.settings.image_ratio.square'),
                    'portrait'  => _t('collection-tiles.settings.image_ratio.portrait'),
                    'landscape' => _t('collection-tiles.settings.image_ratio.landscape'),
                ])->default('square'),

            Settings\Select::make('text_alignment_vertical', _t('collection-tiles.settings.text_alignment_vertical_label'))
                ->options([
                    'top'    => _t('collection-tiles.settings.text_alignment.top'),
                    'center' => _t('collection-tiles.settings.text_alignment.center'),
                    'bottom' => _t('collection-tiles.settings.text_alignment.bottom'),
                ])->default('bottom'),

            Settings\Select::make('text_alignment_horizontal', _t('collection-tiles.settings.text_alignment_horizontal_label'))
                ->options([
                    'start'  => _t('collection-tiles.settings.text_alignment.start'),
                    'center' => _t('collection-tiles.settings.text_alignment.center'),
                    'end'    => _t('collection-tiles.settings.text_alignment.end'),
                ])->default('center'),
        ];
    }

    public static function blocks(): array
    {
        return [
            Block::make('tile', _t('collection-tiles.blocks.tile.name'))
                ->settings([
                    Settings\Image::make('image', _t('collection-tiles.blocks.tile.settings.image_label')),
                    Settings\Text::make('title', _t('collection-tiles.blocks.tile.settings.title_label'))
                        ->default('Our Collection'),
                    Settings\Link::make('link', _t('collection-tiles.blocks.tile.settings.link_label')),
                ])
        ];
    }
}
