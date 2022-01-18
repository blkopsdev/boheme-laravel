<?php

namespace App\Mail;

use App\Project;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnswerSavedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;
    public $route;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project, $route)
    {
        $this->project = $project;
        $this->route = $route;
    }

    private function usingDefaultSmtp()
    {
        $mailTransport = app()->make('mailer')
            ->getSwiftMailer()
            ->getTransport();

        if ($mailTransport instanceof \Swift_SmtpTransport) {
            /** @var \Swift_SmtpTransport $mailTransport */
            $mailTransport->setHost($this->project->company->smtp_host);
            $mailTransport->setUsername($this->project->company->smtp_username);
            $mailTransport->setPassword($this->project->company->smtp_password);
            $mailTransport->setEncryption($this->project->company->smtp_encryption);
            $mailTransport->setPort($this->project->company->smtp_port);
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
        $message = $this->view('emails.answer_saved')
            ->subject('Uw antwoorden zijn opgeslagen')
            ->with('client', $this->project->name)
            ->with('route', $this->route);
        
        $message->usingDefaultSmtp();

        return $message;
    }
}
