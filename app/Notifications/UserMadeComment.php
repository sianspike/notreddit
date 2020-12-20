<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserMadeComment implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $user;
    private $message;
    private $comment;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param Comment $comment
     */
    public function __construct(User $user, Comment $comment) {

        $this -> user = $user;
        $this -> comment = $comment;
        $this -> message = "{$user -> username} commented on your post!";

        $notification = new Notification;
        $notification -> type = "post_comment";
        $notification -> data = $this -> message;
        $notification -> user_id = $this -> user -> id;
        $notification -> recipient_id = $this -> comment -> post -> user_id;
        $notification -> save();
    }

    public function broadcastOn()
    {
        return ['notreddit-notifications'];
    }

    public function broadcastAs() {

        return 'user-commented';
    }
}
