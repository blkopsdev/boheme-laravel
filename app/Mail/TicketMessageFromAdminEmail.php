<?php

namespace App\Mail;

use App\Ticket;
// use App\TicketConversation;
// use App\User;
use App\Company;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMessageFromAdminEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    // public $user;
    // public $conversation;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    private function usingSendersSmtp()
    {
        $mailTransport = app()->make('mailer')
            ->getSwiftMailer()
            ->getTransport();

        if ($mailTransport instanceof \Swift_SmtpTransport) {
            /** @var \Swift_SmtpTransport $mailTransport */
            $mailTransport->setHost($this->user->smtp_host);
            $mailTransport->setUsername($this->user->smtp_username);
            $mailTransport->setPassword($this->user->smtp_password);
            $mailTransport->setEncryption($this->user->smtp_encryption);
            $mailTransport->setPort($this->user->smtp_port);
        }

        return $this;
    }

    private function usingDefaultSmtp()
    {
        $mailTransport = app()->make('mailer')
            ->getSwiftMailer()
            ->getTransport();

        $company = Company::find(1);
        if ($mailTransport instanceof \Swift_SmtpTransport) {
            /** @var \Swift_SmtpTransport $mailTransport */
            $mailTransport->setHost($company->smtp_host);
            $mailTransport->setUsername($company->smtp_username);
            $mailTransport->setPassword($company->smtp_password);
            $mailTransport->setEncryption($company->smtp_encryption);
            $mailTransport->setPort($company->smtp_port);
        }

        return $this;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = $this->view('emails.ticket_message_from_admin')
            ->subject('Actie vereist voor uw ticket')
            ->with('ticket', $this->ticket);
        
        $message->usingDefaultSmtp();

        return $message;
    }
}
