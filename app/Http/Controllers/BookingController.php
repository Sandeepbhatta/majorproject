<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
use App\Models\Bookings; 
use App\Models\Refund;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\RefundController;


use Auth;



class BookingController extends Controller 
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $bookings = Bookings::with('package','user')->orderBy('id', 'asc')->paginate(10);

            return response()->json($bookings);
        } else {
            $bookings = Bookings::with('package','user')->orderBy('id', 'asc')->paginate(10);

            return view('booking.booking', compact('bookings'));
        }
    }


    public function create()
    {
        $packages = Package::all(); // Retrieve all packages from the database
        return view('booking.create', compact('packages'));
    }

    public function store(Request $request)
    {
        
        $user_id = Auth::guard('api')->user()->id;
        $validator = Validator::make($request->all(), [
            'booking_date' => ['required', 'date'],
            'start_date' => ['required', 'date'],
            'end_date' => 'required',
            'package_id' => 'required|exists:packages,id', // Validate package_id and ensure it exists in the packages table

        ]);
        
        if ($validator->passes()) {
            $bookingDate = $request->start_date;
            $existingBooking = Bookings::where('start_date', $bookingDate)->first();

            if ($existingBooking) {
                // Date already booked, store it in the session to highlight in the frontend
                Session::put('blocked_date', $bookingDate);
                return response()->json(['message' => 'This date is blocked.'], 422);
            } else {
                // Date is available for booking
                $booking = new Bookings();
                $booking->booking_date = $request->booking_date;
                $booking->start_date = $request->start_date;
                $booking->end_date = $request->end_date;
                $booking->package_id = $request->package_id;
                $booking->user_id = $user_id; // Add the logged-in user's ID
                $booking->save();

                return response()->json(['message' => 'Booking created successfully.']);
                $startDate = Carbon::parse($request->start_date)->toDateString();
                $calendarDate = Carbon::parse($bookingDate)->toDateString();
                if ($startDate === $calendarDate) {
                    // Clear the session since the selected start_date matches the calendar's date
                    Session::forget('blocked_date');
                }
            }
        }

        return response()->json(['errors' => $validator->errors()], 422);
    }

    public function getBlockedDate()
    {
        $blockedDate = Session::get('blocked_date');
        return response()->json(['blocked_date' => $blockedDate]);
    }


    // public function sendMailNotify($booking,$user_id,$request)
    // {
        
    //     $user = User::find($user_id);
    //     if (!$user) {
    //         $request->session()->flash('error', 'User Not found!');
    //         return redirect()->route('booking.index');
    //     }
        
    //     $email = $user->email;  // Retrieve the email from the user record

    //     $data = [
    //         'title' => "Welcome to Your Function Junction",
    //         'subject' => "Booking Confirmation",
    //         'body' => "Thank you for booking with us. We are glad that we have been able to cherish your remarkable moment.",
    //         'user' => $user, // Set user data to null since we are not using the logged-in user
    //         'booking' => $booking, // Pass the booking data to the email template
    //     ];

    //     try {
    //         Mail::to($user->email)->send(new MailNotify($data));
    //     } catch (Exception $th) {
    //         // Handle the exception
    //     }
    // }


    // ...

    public function edit(Request $request, $id)
    {
        $booking = Bookings::findOrFail($id);

        if ($request->wantsJson()) {
            return response()->json($booking);
        } else {
            return view('booking.edit', ['booking' => $booking]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'booking_date' => ['required', 'date'],
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($validator->passes()) {
            $booking = Bookings::find($id);
            $booking->booking_date = $request->booking_date;
            $booking->start_date = $request->start_date;
            $booking->end_date = $request->end_date;
            $booking->save();

            if ($request->wantsJson()) {
                return response()->json(['message' => 'Booking updated successfully']);
            } else {
                $request->session()->flash('success', 'Booking Edited Successfully!');
                return redirect()->route('booking.index');
            }
        } else {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                return redirect()->route('booking.edit', $id)->withErrors($validator)->withInput();
            }
        }
    }
    public function cancelBooking(Request $request, $id)
    {
        $booking = Bookings::find($id);

        if (!$booking) {
            return back()->with('error', 'Booking not found.');
        }

        // Check if the booking status is already canceled
        if ($booking->status === 1) {
            return back()->with('error', 'Booking is already canceled.');
        }
        // Create an instance of RefundController
        $refundController = new RefundController();
        $refundStatus = $refundController->initiateRefund($booking);

        if ($refundStatus) {
            // If refund initiation is successful, update the booking status to 1 (canceled)
            $booking->status = 1;
            $booking->save();

            return back()->with('success', 'Booking canceled successfully. Refund initiated.');
        } else {
            // Refund initiation failed
            return back()->with('error', 'Failed to initiate refund. Please try again later.');
        }
    }

    public function destroy(Request $request, $id)
    {
        $booking = Bookings::findOrFail($id);
        $booking->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Booking deleted successfully']);
        } else {
            return redirect()->route('booking.index')->with('success', 'Booking deleted successfully');
        }
    }
}