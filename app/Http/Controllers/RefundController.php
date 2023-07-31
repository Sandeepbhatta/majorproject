<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\Refund;

use Carbon\Carbon;

use Illuminate\Support\Facades\Http;


class RefundController extends Controller
{
    public function displayRefunds()
    {
        $refunds = Refund::all(); // Fetch all refunds from the 'refunds' table

        return view('refund.refund', compact('refunds'));
    }

    public function initiateRefund($booking)
    {
        // Logic to check if refund is applicable (e.g., based on booking status)
        if ($booking->status === 0) {
            // If the booking status indicates a cancellation, proceed with the refund

            // Additional check: Verify if the refund was already initiated or completed
            $existingRefund = Refund::where('id', $booking->id)->first();
            if ($existingRefund) {
                if ($existingRefund->status === 'completed') {
                    return false; // Refund already processed for this booking
                } elseif ($existingRefund->status === 'initiated') {
                    return false; // Refund already initiated for this booking
                }
            }

            // If refund condition met, initiate refund through eSewa API
            $amount = 200; 
            $url = 'https://uat.esewa.com.np/epay/transrec';

            $payload = [
                'amt' => $amount,
                'rid' => $booking->id, // You can use the booking ID as a reference for the refund
                'pid' => 'REFUND-' . $booking->id,
                'scd' => 'EPAYTEST',
                // Unique payment ID for the refund
                // Add other required parameters as per eSewa API documentation
            ];
            // Make the refund request using the eSewa API
            $response = Http::post($url, $payload);

            if ($response->successful()) {

                $refund = new Refund();
                $refund->id = $booking->id;
                $refund->amount = $amount;
                $refund->status = 'initiated'; // You can add more statuses like 'completed', 'failed', etc.
                $refund->save();

                return response()->json(['message' => 'Refund initiated successfully'], 200);
            } else {

                return false; 
            }
        }

       
        return false;
    }
    public function checkRefundEligibility(Bookings $booking)
    {

        $bookingStatus = $booking->status;


        // Check if the current date is before the booking date
        $refundEligible = ($bookingStatus === 0);
    
        return $refundEligible;
    }
    public function calculateRefundAmount(Bookings $booking)
    {
        // Get the booking date
        $bookingDate = Carbon::parse($booking->booking_date);

        // Calculate the number of days until the booking date
        $daysUntilBooking = now()->diffInDays($bookingDate, false);

        // Calculate the refund amount based on the number of days until the booking date
        if ($daysUntilBooking >= 30) {
            // 100% refund if canceled 30 days or more before the booking date
            return 100;
        } elseif ($daysUntilBooking >= 15) {
            // 50% refund if canceled between 15 and 29 days before the booking date
            return 50;
        } else {
            // 0% refund if canceled less than 15 days before the booking date
            return 0;
        }
    }
}
