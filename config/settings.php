<?php

use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\ColorSchemeGroup;

return [
    [
        'name' => 'Colors',
        'settings' => [
            ColorScheme::make('default_scheme', 'Default Scheme')
                ->default('default'),

            ColorSchemeGroup::make('color_schemes', 'Color Schemes')
                ->schemes([
                    'default' => [
                        'background' => '#ffffff',
                        'on-background' => '#181a2a',

                        'surface' => '#e8e8e8',
                        'on-surface' => '#181a2a',

                        'surface-alt' => '#d1d1d1',
                        'on-surface-alt' => '#181a2a',

                        'primary' => '#060C3B',
                        'on-primary' => '#ffffff',

                        'secondary' => '#61738d',
                        'on-secondary' => '#ffffff',

                        'accent' => '#009689',
                        'on-accent' => '#ffffff',

                        'neutral' => '#000000',
                        'on-neutral' => '#ffffff',

                        'info' => '#0090b5',
                        'on-info' => '#ffffff',

                        'success' => '#00a43b',
                        'on-success' => '#ffffff',

                        'warning' => '#fbc700',
                        'on-warning' => '#000000',

                        'danger' => '#ff6266',
                        'on-danger' => '#000000',
                    ]
                ])
        ]
    ]
];
