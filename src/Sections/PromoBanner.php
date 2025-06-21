<?php

namespace BagistoPlus\VisualVelocity\Sections;

use BagistoPlus\Visual\Sections\BladeSection;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Link;
use BagistoPlus\Visual\Settings\Text;

use function BagistoPlus\VisualVelocity\_t;

class PromoBanner extends BladeSection
{
    protected static string $view = 'shop::sections.promo-banner';

    protected static string $wrapper = 'div.home-offer';

    public static function settings(): array
    {
        return [
            Text::make('text', _t('promo-banner.settings.text_label'))
                ->default(_t('promo-banner.settings.text_default')),

            Link::make('link', _t('promo-banner.settings.link_label'))
                ->default('/'),

            ColorScheme::make('scheme', _t('common.scheme_label'))
                ->info(_t('common.scheme_info'))
        ];
    }
}
