<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MailNotify;
class MailController extends Controller
{
    //
    public function index()
    {
        $email = $booking->email; // Retrieve the email from the booking record
    
        $data = [
            'title' => "Welcome to Your Function Junction",
            'subject' => "Booking Confirmation Mail",
            'body' => "Thank you for booking with us. We are glad that we have been able to cherish your remarkable moment.",
            'booking' => $booking, // Pass the booking data to the email template
        ];
    
        try {
            Mail::to($email)->send(new MailNotify($data));
            return response()->json(['message' => 'Booking confirmation email sent successfully']);
        } catch (Exception $th) {
            return response()->json(['error' => 'Sorry, something went wrong']);
        }
    }
}
