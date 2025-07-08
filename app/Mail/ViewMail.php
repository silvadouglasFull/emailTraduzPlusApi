<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ViewMail extends Mailable
{
    public $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function build()
    {
        $view = 'emails.welcome';
        if (isset($this->data["view"])) {
            $view = $this->data["view"];
        }
        return $this->view($view)
            ->with(['data' => $this->data])
            ->subject("Message from Great Wall Soluções Linguisticas to {$this->data["name"]}");
    }
}
