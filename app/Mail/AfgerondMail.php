<?php

namespace App\Mail;

use App\Project;
use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfgerondMail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project, User $user)
    {
        $this->project = $project;
        $this->user = $user;
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
        $message = $this->view('emails.afgerond')
            ->from($this->user->email, $this->user->name)
            ->subject('Website staat live!')
            ->with('project', $this->project)
            ->with('user', $this->user);
        
        $message->usingDefaultSmtp();

        return $message;
    }
}
