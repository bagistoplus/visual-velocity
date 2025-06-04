<?php

namespace BagistoPlus\VisualVelocity\Sections;

use BagistoPlus\Visual\Settings\Image;
use BagistoPlus\Visual\Sections\BladeSection;
use BagistoPlus\Visual\Settings\Text;

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
