<?php

namespace App\Notifications;

use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LikePostNotification extends Notification
{
    use Queueable;

    /**
     * User who liked the post
     *
     * @var User
     */
    private User $user;

    /**
     * Post that was liked
     *
     * @var Post
     */
    private Post $post;

    /**
     * Create a new notification instance.
     *
     * @param User $user User who liked the post
     * @param Post $post Post that was liked
     * @return void
     */
    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'type' => 'like',
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'profile_url' => $this->user->url('avatar')
            ],
            'post_id' => $this->post->id,
            'message' => $this->user->name . ' liked your post'
        ];
    }
}
