<?php

namespace App\Mail;

use App\Models\Items;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyVendorFilledCalculateData extends Mailable
{

    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public $item)
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        return $this->subject('Mail from zeepup.com')
            ->from("admin@estatecoordinator.co.uk","ZeepUp")
            ->view('emails.notify-vendor-filled-calculate-data')
            ->bcc(config('mail.from.bcc'));
    }
}
