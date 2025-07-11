<?php

namespace BagistoPlus\VisualVelocity\Sections;

use BagistoPlus\Visual\Sections\BladeSection;
use BagistoPlus\Visual\Sections\Block;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Link;
use BagistoPlus\Visual\Settings\RichText;
use BagistoPlus\Visual\Settings\Text;
use Webkul\Theme\Repositories\ThemeCustomizationRepository;

use function BagistoPlus\VisualVelocity\_t;

class Footer extends BladeSection
{
    protected static string $view = 'shop::sections.footer';

    protected static array $disabledOn = ['*'];

    protected static string $wrapper = 'footer';

    public function getLinks()
    {
        $groups = collect();
        $currentGroup = ['group' => '', 'links' => collect()];

        collect($this->section->blocks)->each(function ($block) use (&$groups, &$currentGroup) {
            if ($block->type === 'group') {
                $currentGroup = [
                    'group' => $block->settings->title ?? '',
                    'links' => collect(),
                ];

                $groups->push($currentGroup);
            }

            if ($block->type === 'link' && $currentGroup) {
                $currentGroup['links']->push([
                    'text' => $block->settings->text,
                    'url' => $block->settings->link
                ]);
            }
        });

        if ($groups->isEmpty() && $currentGroup['links']->isNotEmpty()) {
            $groups->push($currentGroup);
        }

        $groups = $groups->filter(fn($group) => $group['links']->isNotEmpty());

        return $groups->isEmpty() ? $this->getDefaultLinks() : $groups;
    }

    protected function getDefaultLinks()
    {
        $themeCustomizationRepository = app(ThemeCustomizationRepository::class);
        $channel = core()->getCurrentChannel();

        $footerLinks = $themeCustomizationRepository->findOneWhere([
            'type'       => 'footer_links',
            'status'     => 1,
            'channel_id' => core()->getCurrentChannel()->id,
            'theme_code' => 'default',
        ]);

        if (!$footerLinks) {
            return [];
        }

        return collect($footerLinks->options)->map(function ($links, $group) {
            return [
                'group' => $group,
                'links' => collect($links)
                    ->sortBy('sort_order')
                    ->map(fn($link) => ['url' => $this->appendCurrentQueryString($link['url']), 'text' => $link['title']])
            ];
        });
    }

    private function appendCurrentQueryString(string $url): string
    {
        $currentQuery = request()->query();

        $parsedUrl = parse_url($url);
        parse_str($parsedUrl['query'] ?? '', $targetQuery);

        $mergedQuery = array_merge($targetQuery, $currentQuery);

        $base = strtok($url, '?');
        $finalQuery = http_build_query($mergedQuery);

        return $finalQuery ? $base . '?' . $finalQuery : $base;
    }

    public static function name(): string
    {
        return _t('footer.name');
    }

    public static function description(): string
    {
        return _t('footer.description');
    }

    public static function settings(): array
    {
        return [
            RichText::make('copyright', _t('footer.settings.copyright_label'))
                ->default(_t('footer.settings.copyright_default')),

            ColorScheme::make('scheme', _t('common.scheme_label'))
                ->info(_t('common.scheme_info'))
        ];
    }

    public static function blocks(): array
    {
        return [
            Block::make('group', _t('footer.blocks.group.name'))
                ->settings([
                    Text::make('title', _t('footer.blocks.group.settings.title_label'))
                        ->default(_t('footer.blocks.group.settings.title_default')),
                ]),

            Block::make('link', _t('footer.blocks.link.name'))
                ->settings([
                    Text::make('text', _t('footer.blocks.link.settings.text_label'))
                        ->default(_t('footer.blocks.link.settings.text_default')),

                    Link::make('link', _t('footer.blocks.link.settings.link_label'))
                        ->default('/'),
                ]),
        ];
    }
}
