<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nom;
    public $email;
    public $demande;
    public $mess;

    /**
     * Create a new message instance.
     */
    public function __construct($nom,$email,$demande,$mess)
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->demande = $demande;
        $this->mess = $mess;

    }

    public function build(): ContactMail
    {
        
        return $this->view('emails.contact');
    }
}
