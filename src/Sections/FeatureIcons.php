<?php

namespace BagistoPlus\VisualVelocity\Sections;

use BagistoPlus\Visual\Facades\ThemeEditor;
use BagistoPlus\Visual\Settings\Icon;
use BagistoPlus\Visual\Settings\Text;
use BagistoPlus\Visual\Sections\Block;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Textarea;

use function BagistoPlus\VisualVelocity\_t;
use BagistoPlus\Visual\Sections\BladeSection;

class FeatureIcons extends BladeSection
{
    protected static string $view = 'shop::sections.feature-icons';

    public static function name(): string
    {
        return _t('feature-icons.name');
    }

    public static function description(): string
    {
        return _t('feature-icons.description');
    }

    public static function settings(): array
    {
        return [
            Range::make('icon_size', _t('feature-icons.settings.icon_size_label'))
                ->min(16)->max(40)->step(4)->unit('px')->default(32),

            Range::make('columns', _t('feature-icons.settings.columns_label'))
                ->min(3)->max(6)->step(1)->default(4),
        ];
    }

    public static function blocks(): array
    {
        return [
            Block::make('feature', _t('feature-icons.blocks.feature.label'))
                ->settings([
                    Icon::make('icon', _t('feature-icons.blocks.feature.settings.icon_label')),
                    Text::make('title', _t('feature-icons.blocks.feature.settings.title_label')),
                    Textarea::make('text', _t('feature-icons.blocks.feature.settings.text_label')),
                ]),
        ];
    }

    public static function default(): array
    {
        return [
            'blocks' => [
                [
                    'type' => 'feature',
                    'settings' => [
                        'icon' => 'lucide-truck',
                        'title' => 'Free Shipping',
                        'text' => 'Enjoy free shipping on all orders'
                    ]
                ],
                [
                    'type' => 'feature',
                    'settings' => [
                        'icon' => 'lucide-package-check',
                        'title' => 'Product Replace',
                        'text' => 'Easy Product Replacement Available!'
                    ]
                ],
                [
                    'type' => 'feature',
                    'settings' => [
                        'icon' => 'lucide-dollar-sign',
                        'title' => 'Emi Available',
                        'text' => 'No cost EMI available on all major credit cards'
                    ]
                ],
                [
                    'type' => 'feature',
                    'settings' => [
                        'icon' => 'lucide-headset',
                        'title' => '24/7 Support',
                        'text' => 'Dedicated 24/7 support via chat and email'
                    ]
                ]
            ]
        ];
    }

    public function getFeatures(): array
    {
        if (count($this->section->blocks) > 0) {
            return collect($this->section->blocks)->map(fn($block) => [
                'icon'  => $block->settings->icon ?? null,
                'title' => $block->settings->title ?? '',
                'text'  => $block->settings->text ?? '',
                'liveUpdateTitle' => $block->liveUpdate()->text('title'),
                'liveUpdateText'  => $block->liveUpdate()->text('text'),
            ])->all();
        }

        if (ThemeEditor::inDesignMode()) {
            return array_fill(0, 4, [
                'icon'  => null,
                'title' => _t('feature-icons.placeholders.title'),
                'text'  => _t('feature-icons.placeholders.text'),
            ]);
        }

        return [];
    }
}
