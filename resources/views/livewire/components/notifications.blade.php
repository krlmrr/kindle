<?php
    use Livewire\Attributes\On;
    use function Livewire\Volt\{on, state};

    state([
        'notifications' => auth()->user()->unreadNotifications,
        'userId' => auth()->user()->id,
    ]);

    on(['echo-private:App.Models.User.{userId},.notification' => function ($notification) {
        $this->notifications = auth()->user()->unreadNotifications;
    }]);

    $markAsRead = function ($notification) {
        auth()->user()->notifications->findOrFail($notification['id'])->markAsRead();

        $this->notifications = auth()->user()->unreadNotifications;
    };
?>

<div>
    <flux:dropdown align="end">
        <flux:button variant="ghost">
            @if (count($notifications) > 0)
                <flux:icon.bell-alert class="text-red-500 dark:text-red-400" />
            @else
                <flux:icon.bell class="dark:text-gray-400"/>
            @endif
        </flux:button>

        <flux:menu class="w-56">
            @if(count($notifications))
                @foreach($notifications as $notification)
                    <div class="flex items-center gap-2">
                        <flux:menu.item>
                            {{ $notification->data['message'] }}
                        </flux:menu.item>

                        <flux:button
                            icon="x-mark"
                            variant="subtle"
                            wire:click="markAsRead({{ $notification }})"
                        />
                    </div>
                @endforeach
            @else
                <flux:menu.item disabled>
                    No notifications
                </flux:menu.item>
            @endif
        </flux:menu>
    </flux:dropdown>
</div>
