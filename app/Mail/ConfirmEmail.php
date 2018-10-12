<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = url('/api/auth/signup/activate/'.$this->data->activation_token);

        $address = 'antitheftkit@gmail.com';
        $subject = 'Confirm your account';
        $name = 'Anti-Theft Kit';

        return $this->markdown('emails.confirmEmail')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([
                        'confirmationLink' => $url,
                        'name' => $this->data['fullname']
                    ]);
    }
}
