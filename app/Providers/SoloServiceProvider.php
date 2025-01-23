<?php

namespace App\Providers;

use AaronFrancis\Solo\Facades\Solo;
use Illuminate\Support\ServiceProvider;

class SoloServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (class_exists('\AaronFrancis\Solo\Manager')) {
            $this->configure();
        }
    }

    public function configure()
    {
        Solo::useTheme('dark')
            ->addCommands([
                'Vite' => 'npm run dev',
                'Queue' => 'php artisan queue:listen --tries=1',
                'Horizon' => 'php artisan horizon',
                'Schedule' => 'php artisan schedule:work',
                // If you are using Laravel Herd, you don't need to run this since it is already running.
                // Uncomment this if you are not using Laravel Herd.
                // 'Reverb' => 'php artisan reverb:start',
            ])
            ->addLazyCommands([
                'Logs' => 'php artisan pail',
                // 'Pint' => 'pint --ansi',
            ])
            // FQCNs of trusted classes that can add commands.
            ->allowCommandsAddedFrom([
                //
            ]);
    }

    public function boot()
    {
        //
    }
}
