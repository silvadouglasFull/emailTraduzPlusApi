<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class WelcomeMail extends Mailable
{
    public $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('emails.welcome')
            ->with(['data' => $this->data])
            ->subject("Message from Great Wall Soluções Linguisticas to {$this->data["name"]}");
    }
}
