<?php

namespace BagistoPlus\VisualVelocity\Sections;

use BagistoPlus\Visual\Settings\Image;
use BagistoPlus\Visual\Sections\BladeSection;
use BagistoPlus\Visual\Sections\Block;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Icon;
use BagistoPlus\Visual\Settings\RichText;
use BagistoPlus\Visual\Settings\Text;
use BagistoPlus\Visual\Settings\Textarea;

use function BagistoPlus\VisualVelocity\_t;

class MobileHeader extends BladeSection
{
    protected static string $view = 'shop::sections.mobile-header';

    protected static string $wrapper = 'header';

    protected static array $disabledOn = ['*'];

    public static function settings(): array
    {
        return [
            Image::make('logo', _t('mobile-header.settings.logo_label'))
                ->default(asset('themes/shop/visual-velocity/images/logo.svg')),

            Text::make('logo_text', _t('mobile-header.settings.logo_text_label')),

            ColorScheme::make('scheme', _t('common.scheme_label'))
                ->info(_t('common.scheme_info'))
        ];
    }

    public static function blocks(): array
    {
        return [

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
                    Icon::make('icon', _t('header.blocks.user.settings.icon_label'))
                ]),
        ];
    }

    public static function default(): array
    {
        return [
            'blocks' => [
                ['type' => 'compare'],
                ['type' => 'minicart'],
                ['type' => 'user'],
            ],
        ];
    }

    public function getViewData(): array
    {
        return [
            'showCompare' => (bool) core()->getConfigData('catalog.products.settings.compare_option'),
            'showWishlist' => (bool) core()->getConfigData('customer.settings.wishlist.wishlist_option')
        ];
    }
}
