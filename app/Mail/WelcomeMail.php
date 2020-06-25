<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable {
  use Queueable, SerializesModels;

  public $data;

  public function __construct($data) {
    $this->data = $data;
  }

  public function build() {
    $subject = 'Successfully registration';

    return $this->markdown('emails.welcome')
        ->subject($subject)
        ->with(['message' => $this->data['message']]);
  }
}
