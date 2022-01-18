<?php

namespace App\Mail;

use App\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketCreateEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $ticket;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.ticket_submit_email')
        ->subject('Nieuwe ticket ontvangen | ' . $this->ticket->name)
        ->with('ticket', $this->ticket);
    }
}
