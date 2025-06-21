<?php

namespace BagistoPlus\VisualVelocity\Sections;

use BagistoPlus\Visual\Sections\BladeSection;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Link;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Settings\Text;

use function BagistoPlus\VisualVelocity\_t;

class TopBar extends BladeSection
{
    protected static string $view = 'shop::sections.top-bar';

    protected static array $disabledOn = ['*'];

    public static function settings(): array
    {
        return [
            Checkbox::make('show_announcement', _t('top-bar.settings.show_announcement_label'))
                ->default(true),

            Text::make('announcement', _t('top-bar.settings.announcement_label'))
                ->default(_t('top-bar.settings.announcement_default')),

            Link::make('announcement_link', _t('top-bar.settings.announcement_link_label'))
                ->default('/'),

            Text::make('announcement_link_text', _t('top-bar.settings.announcement_link_text_label'))
                ->default(_t('top-bar.settings.announcement_link_text_default')),

            Checkbox::make('show_currency_switcher', _t('top-bar.settings.show_currency_switcher_label'))
                ->default(true),

            Checkbox::make('show_locale_switcher', _t('top-bar.settings.show_locale_switcher_label'))
                ->default(true),

            Select::make('variant', _t('top-bar.settings.variant_label'))
                ->options([
                    'default'   => 'Default',
                    'primary'   => 'Primary',
                    'secondary' => 'Secondary',
                    'accent'    => 'Accent',
                ])->default('default'),

            ColorScheme::make('scheme', _t('common.scheme_label'))
                ->info(_t('common.scheme_info'))
        ];
    }

    public static function blocks(): array
    {
        // section blocks
        return [];
    }
}
