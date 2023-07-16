<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;


class MailNotify extends Mailable
{
    use Queueable, SerializesModels;



    private $booking;
    private $email;
    private $data;

    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->booking = $data['booking'];
        $this->email = $this->booking->email;
        $this->data = $data; // Assign the $data parameter to the $data property

    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email, 'Your Function Junction')
            ->subject($this->data['subject'])
            ->view('email.index')
            ->with('data', $this->data)
            ->with('booking', $this->booking)
            ->with('user', null); // Set user data to null since we are not using the logged-in user
    }
    


    // public function envelope()
    // {
    //     return new Envelope(
    //         from: new Address('manis.devkota555@gmail.com'),
    //         subject: 'Booking Confirmation Mail',
    //     );
    // }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(

    //         view: 'email.booking-mail',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    // public function attachments()
    // {
    //     return [];
    // }
}
