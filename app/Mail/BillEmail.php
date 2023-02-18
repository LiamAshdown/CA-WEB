<?php

namespace App\Mail;

use App\Models\Bill;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BillEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Bill
     * 
     * @var Bill
     */
    public Bill $bill;

    /**
     * Body
     *
     * @var string
     */
    private string $body;

    /**
     * Create a new message instance.
     *
     * @param  Bill  $bill
     * @param  string  $body
     * @return void
     */
    public function __construct(Bill $bill, string $body)
    {
        $this->bill = $bill;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->bill->company->name . ' '. ucfirst($this->bill->type) . ' #' . $this->bill->reference;
        $pdfFilename = $this->bill->type == 'quote' ? 'quote.pdf' : 'invoice.pdf';
        
        return $this->view('emails.general')
                    ->subject($subject)
                    ->with([
                        'title' => $subject,
                        'body' => $this->body
                    ])
                    ->attachData($this->bill->pdf(true), $pdfFilename);
    }
}
