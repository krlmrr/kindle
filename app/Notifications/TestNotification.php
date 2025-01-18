<?php

namespace App\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class TestNotification extends Notification
{
    use Queueable;

    public function __construct() {}

    public function via(object $notifiable): array
    {
        return ['broadcast', 'database'];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'message' => 'Test Notification',
        ]);
    }

    public function broadcastOn()
    {
        return new PrivateChannel('App.Models.User.1');
    }

    public function broadcastAs(): string
    {
        return 'notification';
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Test Notification',
        ];
    }
}
