<?php

namespace BagistoPlus\VisualVelocity\Sections;

use BagistoPlus\Visual\Settings\Image;
use BagistoPlus\Visual\Sections\BladeSection;
use BagistoPlus\Visual\Sections\Block;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Icon;
use BagistoPlus\Visual\Settings\Number;
use BagistoPlus\Visual\Settings\RichText;
use BagistoPlus\Visual\Settings\Text;
use BagistoPlus\Visual\Settings\Textarea;

use function BagistoPlus\VisualVelocity\_t;

class Header extends BladeSection
{
    protected static string $view = 'shop::sections.header';

    protected static array $disabledOn = ['*'];

    public static function settings(): array
    {
        return [
            ColorScheme::make('scheme', _t('common.scheme_label'))
                ->info(_t('common.scheme_info'))
        ];
    }

    public static function blocks(): array
    {
        return [
            Block::make('logo', _t('header.blocks.logo.name'))
                ->limit(1)
                ->settings([
                    Image::make('logo', _t('header.blocks.logo.settings.logo_image_label'))
                        ->default(asset('themes/shop/visual-velocity/images/logo.svg')),

                    Text::make('logo_text', _t('header.blocks.logo.settings.logo_text_label'))
                        ->default(_t('header.blocks.logo.settings.logo_text_default'))
                        ->info(_t('header.blocks.logo.settings.logo_text_info')),
                ]),

            Block::make('navigation', _t('header.blocks.navigation.name'))
                ->limit(1)
                ->settings([
                    Checkbox::make('show_in_sidebar', _t('header.blocks.navigation.settings.show_in_sidebar_label'))
                        ->default(true),

                    Number::make('number_of_items_in_header', _t('header.blocks.navigation.settings.number_of_items_in_header_label'))
                        ->default(3)
                        ->min(0)
                        ->max(6),
                ]),

            Block::make('search', _t('header.blocks.search.name'))
                ->limit(1)
                ->settings([
                    Icon::make('search_icon', _t('header.blocks.search.settings.search_icon_label'))
                        ->default('lucide-search'),
                ]),

            Block::make('compare', _t('header.blocks.compare.name'))
                ->limit(1)
                ->settings([
                    Icon::make('icon', _t('header.blocks.compare.settings.icon_label'))
                ]),

            Block::make('minicart', _t('header.blocks.minicart.name'))
                ->limit(1)
                ->settings([
                    Icon::make('icon', _t('header.blocks.minicart.settings.icon_label')),

                    Text::make('heading', _t('header.blocks.minicart.settings.heading_label'))
                        ->default(__('shop::app.checkout.cart.mini-cart.shopping-cart')),

                    RichText::make('description', _t('header.blocks.minicart.settings.description_label'))
                        ->default(_t('header.blocks.minicart.settings.description_default')),
                ]),

            Block::make('user', _t('header.blocks.user.name'))
                ->limit(1)
                ->settings([
                    Icon::make('icon', _t('header.blocks.user.settings.icon_label')),

                    Text::make('guest_heading', _t('header.blocks.user.settings.guest_heading_label'))
                        ->default(trans('shop::app.components.layouts.header.desktop.bottom.welcome-guest')),

                    Textarea::make('guest_description', _t('header.blocks.user.settings.guest_description_label'))
                        ->default(trans('shop::app.components.layouts.header.desktop.bottom.dropdown-text'))
                ]),
        ];
    }

    public static function default(): array
    {
        return [
            'blocks' => [
                ['type' => 'logo'],
                ['type' => 'navigation'],
                ['type' => 'search'],
                ['type' => 'compare'],
                ['type' => 'minicart'],
                ['type' => 'user'],
            ],
        ];
    }
}
