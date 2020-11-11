<?php

namespace App\Notifications;

use App\Mail\DonatedItemMail;
use Illuminate\Bus\Queueable;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Requests\DTO\DonatedItemNotiDTO;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class DonatedItemNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $notiData;
    public $uuid;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(DonatedItemNotiDTO $notiData)
    {
        $this->notiData = $notiData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $this->uuid = $notifiable->uuid;
        return ['broadcast', 'database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $intro = $this->notiData->name . " donated " . $this->notiData->about_item;
        $phone = "Contact Phone Number - " . $this->notiData->phone;
        return (new MailMessage)
            ->line($intro)
            ->line($phone)
            ->action('Check Item', $this->notiData->url);
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
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->id,
            'url' => $this->notiData->url,
            'name' => $this->notiData->name,
            'phone' => $this->notiData->phone,
            'about_item' => $this->notiData->about_item,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->id,
            'url' => $this->notiData->url,
            'name' => $this->notiData->name,
            'phone' => $this->notiData->phone,
            'about_item' => $this->notiData->about_item,
            'created_at' => '0 minute ago'
        ]);
    }

    public function broadcastOn()
    {
        return new Channel('donated-item-' . $this->uuid);
    }
}
