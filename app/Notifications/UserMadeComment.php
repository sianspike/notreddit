<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserMadeComment implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $user;
    protected $comment;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param Comment $comment
     */
    public function __construct(User $user, Comment $comment) {

        $this -> user = $user;
        $this -> comment = $comment;
    }

    public function broadcastOn()
    {
        return ['my-channel'];
    }

    public function broadcastAs() {

        return 'my-event';
    }
}
