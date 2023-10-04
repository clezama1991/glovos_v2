<?php

namespace App\Notifications;

use App\Channels\Messages\WhatsAppMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Channels\WhatsAppChannel;
use App\Models\Pedidos as Order;
use Carbon\Carbon;


class OrderProcessed extends Notification
{
  use Queueable;


  public $order;
  
  public function __construct(Order $order)
  {
    $this->order = $order;
  }
  
  public function via($notifiable)
  {
    return [WhatsAppChannel::class];
  }
  
  
  public function toWhatsApp($notifiable)
  {
    // $orderUrl = url("/orders/{$this->order->id}");
    
    $orderUrl = 'https://gestion.volarenasturias.com/completed_form/'.$this->order->token;
   
    $company = 'Volarenasturias';
    
    $fecha_vuelo = '';    
    if($this->order->vuelo){ $date = new Carbon($this->order->vuelo->fecha); $fecha_vuelo = $date->toFormattedDateString();}
    
    $hora_vuelo = '';    
    if($this->order->vuelo){ $hour = new Carbon(date('Y-m-d').''.$this->order->vuelo->hora); $hora_vuelo = $hour->format('h:i A');}
 
    $ubicacion = '';    
    if($this->order->vuelo && $this->order->vuelo->zona){ $ubicacion = $this->order->vuelo->zona->url_despegue_1;}
 
    $nota = '';    
    if($this->order->vuelo && $this->order->vuelo->zona){ $nota = $this->order->vuelo->zona->mensaje_personalizado;}
 
    $zona = 'No Definida';
    if($this->order->vuelo && $this->order->vuelo->zona){ $zona = $this->order->vuelo->zona->nombre;}


    $message ='Buenas tardes. Para el vuelo de '.$fecha_vuelo.' en '.$zona.' vamos a quedar a las '.$hora_vuelo.' en la siguiente ubicación '.$ubicacion.';
    
    Nota: '.$nota.'

    En el siguiente formulario tendréis que rellenar los datos y los pesos de los pasajeros '. $orderUrl;

    return (new WhatsAppMessage)
        ->content($message);
        
  }

  public function toWhatsAppOld($notifiable)
  {
    $orderUrl = url("/orders/{$this->order->id}");
    $company = 'Volarenasturias';
    $deliveryDate = $this->order->created_at->addDays(4)->toFormattedDateString();

    

    return (new WhatsAppMessage)
        ->content("Your {$company} order of {$this->order->orden_wordpress} has shipped and should be delivered on {$deliveryDate}. Details: {$orderUrl}");
  }
}