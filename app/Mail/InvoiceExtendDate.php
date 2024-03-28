<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceExtendDate extends Mailable
{
    use Queueable, SerializesModels;

    protected $filePath;
    public $order_id;
    public $invoice_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($filePath, $order_id, $invoice_data)
    {
        $this->filePath = $filePath;
        $this->order_id = $order_id;
        $this->invoice_data = $invoice_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.extended_date')
                ->subject(__('Extend Subscription Expiry Date').' '.$this->order_id)
                ->attach($this->filePath)
                ->with('order', $this->invoice_data);
    }
}
