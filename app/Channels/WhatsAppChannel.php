<?php
namespace App\Channels;

use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class WhatsAppChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWhatsApp($notifiable);
 
        $to = $notifiable->routeNotificationFor('WhatsApp');
        $from = config('services.twilio.whatsapp_from');


        $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));


        // return $twilio->messages 
        // ->create("+14155238886", // to 
        //          array(  
        //              "messagingServiceSid" => "MGad5acb62dbc7288b09fa2202835188a6",      
        //              "body" => "hola" 
        //          ) 
        // ); 
        return $twilio->messages 
                ->create("whatsapp:+584262617802", // to 
                        array( 
                            "from" => "whatsapp:+14155238886",       
                            "body" => $message->content
                        ) 
                );

        // return $twilio->messages->create('whatsapp:' . $to, [
        //     "from" => 'whatsapp:' . $from,
        //     "body" => $message->content
        // ]);
    }
}