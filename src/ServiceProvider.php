<?php

namespace BagistoPlus\VisualVelocity;

use BagistoPlus\Visual\Providers\ThemeServiceProvider;
use Illuminate\Support\Facades\Blade;

class ServiceProvider extends ThemeServiceProvider
{
    public function register(): void
    {
        parent::register();
    }

    public function boot(): void
    {
        parent::boot();

        Blade::directive('vue', function () {
            return "<?php if (\\ThemeEditor::inDesignMode()): ?><div data-vue><?php endif; ?>";
        });

        Blade::directive('endvue', function () {
            return "<?php if (\\ThemeEditor::inDesignMode()): ?></div><?php endif; ?>";
        });
    }
}
