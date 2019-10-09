<?php

namespace App\Listeners;

use App\Mail\ProductBoughtMail;
use App\Events\ProductBoughtEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductBoughtListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ProductBoughtEvent $event)
    {
        try {
            Log::notice('Mail sent!');
            Mail::to('kontakt@andreas-pabst.de')->send(new ProductBoughtMail($event->product));
        } catch (Exception $e) {
            Log::critical('Mail not sent!');
        }
    }
}
