<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;
 public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
         $this->details = $details;
    }

   public function build()
    {
        return $this->subject('Mail from it.zeepup.com')->from("info@zeepup.estatecoordinator.co.uk","ZeepUp")
                    ->view('emails.subscription-mail')
                    ->bcc(config('mail.from.bcc'));
    }
}
