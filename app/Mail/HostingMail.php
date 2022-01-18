<?php

namespace App\Mail;

use App\Hosting;
use App\Project;
use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HostingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $form;
    public $project;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project, User $user, Hosting $form)
    {
        $this->form = $form;
        $this->project = $project;
        $this->user = $user;
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
        $message = $this->from($this->user->email, $this->user->name)
            ->view('emails.hosting')
            ->subject('Laatste stappen website')
            ->with('user', $this->user)
            ->with('project', $this->project)
            ->with('form', $this->form);

        if ($this->user->confirm_smtp == 1) {
            $message->usingSendersSmtp();
        } else {
            $message->usingDefaultSmtp();
        }

        return $message;
    }
}
