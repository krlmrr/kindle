<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

        @fluxStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-white dark:bg-zinc-800 text-gray-600 dark:text-gray-400 min-h-screen">
        <livewire:components.navigation />

        @if (isset($header))
            <div class="max-w-7xl mx-auto pt-6 px-6 lg:px-8">
                <flux:heading size="xl" level="1">
                    {{ $header }}
                </flux:heading>
            </div>
        @endif

        <main>
            {{ $slot }}
        </main>

        <flux:toast />

        @fluxScripts
    </body>
</html>
