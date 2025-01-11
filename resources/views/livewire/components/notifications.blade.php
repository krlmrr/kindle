<?php

use function Livewire\Volt\state;

state([
    'notifications' => []
]);
?>

<div>
    <flux:dropdown align="end">
        <flux:button variant="ghost">
            @if(count($notifications) > 0)
                <flux:icon.bell-alert />
            @else
                <flux:icon.bell />
            @endif
        </flux:button>

        <flux:menu>
            <flux:menu.item>
                Notification
            </flux:menu.item>
        </flux:menu>
    </flux:dropdown>
</div>
