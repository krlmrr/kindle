<?php

use SoloTerm\Solo\Commands\Command;
use SoloTerm\Solo\Commands\EnhancedTailCommand;
use SoloTerm\Solo\Commands\MakeCommand;
use SoloTerm\Solo\Hotkeys as Hotkeys;
use SoloTerm\Solo\Themes as Themes;

if (! class_exists('\SoloTerm\Solo\Manager')) {
    return [];
}

return [
    'theme' => env('SOLO_THEME', 'dark'),

    'themes' => [
        'light' => Themes\LightTheme::class,
        'dark' => Themes\DarkTheme::class,
    ],

    'keybinding' => env('SOLO_KEYBINDING', 'default'),

    'keybindings' => [
        'default' => Hotkeys\DefaultHotkeys::class,
        'vim' => Hotkeys\VimHotkeys::class,
    ],

    'commands' => [
        'Make' => new MakeCommand,
        'Vite' => 'npm run dev',
        'Queue' => Command::from('php artisan queue:work'),
        'Logs' => EnhancedTailCommand::file(storage_path('logs/laravel.log')),
        // 'HTTP' => 'php artisan serve',
        // 'Tests' => Command::from('php artisan test --colors=always')->lazy(),
        'Pint' => Command::from('./vendor/bin/pint --ansi')->lazy(),
        'Dumps' => Command::from('php artisan solo:dumps')->lazy(),
        'Reverb' => Command::from('php artisan reverb')->lazy(),
    ],

    'dump_server_host' => env('SOLO_DUMP_SERVER_HOST', 'tcp://127.0.0.1:9984'),
];
