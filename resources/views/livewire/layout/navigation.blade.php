<?php

use App\Livewire\Actions\Logout;
use function Livewire\Volt\state;

state([
    'navLinks' => [
        [
            'name' => 'Dashboard',
            'routeName' => 'dashboard'
        ]
    ],
    'additionalServices' => [
        [
            'name' => 'Nova',
            'href' => '/nova',
        ], [
            'name' => 'Pulse',
            'href' => '/pulse',
        ], [
            'name' => 'Telescope',
            'href' => '/telescope',
        ], [
            'name' => 'Horizon',
            'href' => '/horizon',
        ]
    ]
]);

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};
?>

<nav x-data="{ open: false }" class="border-b border-zinc-200 dark:border-zinc-500">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <flux:navbar class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @foreach ($navLinks as $link)
                        <flux:navbar.item
                            :href="route($link['routeName'])"
                            :current="request()->routeIs($link['routeName'])"
                            :badge="$link['badge'] ?? null"
                        >
                            {{ $link['name'] }}
                        </flux:navbar.item>
                    @endforeach
                </flux:navbar>
            </div>

            <div class="flex items-center space-x-2">
                <x-theme-switcher />

                <livewire:components.notifications />

                <!-- Settings Dropdown -->
                <flux:dropdown align="end" class="hidden sm:flex sm:items-center">
                    <flux:button variant="ghost" icon-trailing="chevron-down">
                        {{ auth()->user()->name }}
                    </flux:button>

                    <flux:menu>
                        <flux:menu.item
                            :href="route('profile')"
                            wire:navigate
                        >
                            Profile
                        </flux:menu.item>

                        @can('use_services')
                            <flux:navlist>
                                <flux:separator class="my-1"/>
                                <flux:navlist.group>
                                    @foreach ($additionalServices as $service)
                                        <flux:navlist.item
                                            :href="$service['href']"
                                            target="_blank"
                                        >
                                            {{ $service['name'] }}
                                        </flux:navlist.item>
                                    @endforeach
                                </flux:navlist.group>
                                <flux:separator class="my-1"/>
                            </flux:navlist>
                        @endcan

                        <flux:menu.item
                            wire:click="logout"
                        >
                            Log Out
                        </flux:menu.item>
                    </flux:menu>
                </flux:dropdown>
            </div>

            <flux:button
                square
                variant="ghost"
                class="flex items-center sm:hidden"
                @click="open = ! open"
            >
                <flux:icon.bars-3 />
            </flux:button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden mb-2">
        <flux:navlist>
            <flux:navlist.group class="px-4">
                @foreach ($navLinks as $link)
                    <flux:navlist.item
                        :href="route($link['routeName'])"
                        :current="request()->routeIs($link['routeName'])"
                    >
                        {{ $link['name'] }}
                    </flux:navlist.item>
                @endforeach
            </flux:navlist.group>
        </flux:navlist>

        <flux:separator class="my-1" />

        <flux:navlist>
            <flux:navlist.group class="px-4">
                <flux:navlist.item
                    :current="request()->routeIs('profile')"
                    :href="route('profile')"
                    wire:navigate
                >
                    {{ auth()->user()->name }}
                </flux:navlist.item>

                <flux:navlist.item
                    wire:click="logout"
                >
                    Log Out
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>
    </div>
</nav>
