<?php

use BagistoPlus\Visual\Settings;

return [
    [
        'name' => 'visual-velocity::theme.settings.colors',
        'settings' => [
            Settings\ColorScheme::make('default_scheme', 'visual-velocity::theme.settings.default_scheme_label')
                ->default('default'),

            Settings\ColorSchemeGroup::make('color_schemes', 'visual-velocity::theme.settings.color_schemes')
                ->schemes([
                    'default' => [
                        'background' => '#ffffff',
                        'on-background' => '#09090b',

                        'surface' => '#f4f4f5',
                        'on-surface' => '#09090b',

                        'surface-alt' => '#e4e4e7',
                        'on-surface-alt' => '#09090b',

                        'primary' => '#060C3B',
                        'on-primary' => '#ffffff',

                        'secondary' => '#F1EADF',
                        'on-secondary' => '#18181b',

                        'accent' => '#f59e0b',
                        'on-accent' => '#fffbeb',

                        'neutral' => '#383D41',
                        'on-neutral' => '#E2E3E5',

                        'info' => '#0090b5',
                        'on-info' => '#ffffff',

                        'success' => '#155721',
                        'on-success' => '#D4EDDA',

                        'warning' => '#856404',
                        'on-warning' => '#FFF3CD',

                        'danger' => '#721C24',
                        'on-danger' => '#F8D7DA',
                    ],
                    'mocha' => [
                        'background' => '#f8f8f8',
                        'on-background' => '#272322',

                        'surface' => '#f5f5f4',
                        'on-surface' => '#272322',

                        'surface-alt' => '#e6e4e3',
                        'on-surface-alt' => '#272322',

                        'primary' => '#92400e',
                        'on-primary' => '#ffffff',

                        'secondary' => '#44403c',
                        'on-secondary' => '#ffffff',

                        'accent' => '#4ade80',
                        'on-accent' => '#000000',

                        'neutral' => '#6b7280',
                        'on-neutral' => '#ffffff',

                        'info' => '#2563eb',
                        'on-info' => '#ffffff',

                        'success' => '#059669',
                        'on-success' => '#ffffff',

                        'warning' => '#d97706',
                        'on-warning' => '#ffffff',

                        'danger' => '#dc2626',
                        'on-danger' => '#ffffff',
                    ],
                    'dark' => [
                        'background' => '#1d232a',
                        'on-background' => '#ecf9ff',

                        'surface' => '#191e24',
                        'on-surface' => '#ecf9ff',

                        'surface-alt' => '#15191e',
                        'on-surface-alt' => '#ecf9ff',

                        'primary' => '#605dff',
                        'on-primary' => '#edf1fe',

                        'secondary' => '#f43098',
                        'on-secondary' => '#f9e4f0',

                        'accent' => '#00d3bb',
                        'on-accent' => '#084d49',

                        'neutral' => '#09090b',
                        'on-neutral' => '#e4e4e7',

                        'info' => '#00bafe',
                        'on-info' => '#042e49',

                        'success' => '#00d390',
                        'on-success' => '#004c39',

                        'warning' => '#fcb700',
                        'on-warning' => '#793205',

                        'danger' => '#ff637d',
                        'on-danger' => '#4d0218',

                    ]
                ])
        ]
    ],
    [
        'name' => 'visual-velocity::theme.settings.typography',
        'settings' => [
            Settings\Font::make('default_font', 'visual-velocity::theme.settings.default_font_label')->default('poppins')
                ->info('visual-velocity::theme.settings.default_font_info'),

            Settings\Font::make('heading_font', 'visual-velocity::theme.settings.heading_font_label')->default('dm-serif-display')
                ->info('visual-velocity::theme.settings.heading_font_info'),
        ],
    ],
];
