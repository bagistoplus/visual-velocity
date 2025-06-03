<?php

namespace BagistoPlus\VisualVelocity\Sections;

use BagistoPlus\Visual\Sections\BladeSection;
use BagistoPlus\Visual\Settings\Text;

class Test extends BladeSection
{
  protected static string $view = 'shop::sections.test';

  public static function settings(): array
  {
    // section settings
    return [
      Text::make('text', 'Button Text')
        ->default('Click Me'),
    ];
  }

  public static function blocks(): array
  {
    // section blocks
    return [];
  }
}
