<?php

namespace App\Notifications;

use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VendorCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $vendor;
    public function __construct(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = sprintf('%s:     لقد تم إنشاء حسابكم في موقعنا  %s!',config('app.name'),'Yasser');
        $greeting =sprintf('!%s مرحبا',$notifiable->name);
        
        return (new MailMessage)
                    ->subject($subject)
                    ->greeting($greeting)
                    ->salutation('يمكنك الاستمتاع بخدماتنا الان بكل محبة 1')
                    ->line('يمكنك الاستمتاع بخدماتنا الان بكل محبة 2')
                    ->action('Notification Action', url('/admin/login'))
                    ->line('يمكنك الاستمتاع بخدماتنا الان بكل محبة 3');
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
}
