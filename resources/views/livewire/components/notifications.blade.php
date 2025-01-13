<?php

use Livewire\Attributes\On;
use function Livewire\Volt\state;

state([
    'notifications' => auth()->user()->notifications()->get(),
    'userId' => auth()->user()->id,
]);

#[On('echo-private:notifications.{userId}, TestNotification')]
function refreshNotifications($payload)
{
    $this->notifications->refresh();
}
?>

<div>
    <flux:dropdown align="end">
        <flux:button variant="ghost">
            @if (count($notifications) > 0)
                <flux:icon.bell-alert class="dark:text-gray-300" />
            @else
                <flux:icon.bell class="dark:text-gray-400"/>
            @endif
        </flux:button>

        <flux:menu>
            @if(count($notifications))
                @foreach($notifications as $notification)
                    <flux:menu.item>
                        {{ $notification->data['message'] }}
                    </flux:menu.item>
                @endforeach
            @else
                <flux:menu.item>
                    No notifications
                </flux:menu.item>
            @endif
        </flux:menu>
    </flux:dropdown>
</div>
