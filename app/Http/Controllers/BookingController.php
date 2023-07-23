<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
use App\Models\Bookings;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
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
        
        $user_id = Auth::id(); //Auth::id();
        $validator = Validator::make($request->all(), [
            'booking_date' => ['required', 'date'],
            'start_date' => 'required',
            'end_date' => 'required',
            'package_id' => 'required|exists:packages,id', // Validate package_id and ensure it exists in the packages table

        ]);
        
        if ($validator->passes()) {

            $booking = new Bookings();
            $booking->booking_date = $request->booking_date;
            $booking->start_date = $request->start_date;
            $booking->end_date = $request->end_date;
            $booking->package_id = $request->package_id;
            $booking->user_id =  $user_id; // Add the logged-in user's ID
            $booking->save();

            $this->sendMailNotify($request);

            return response()->json(['message' => 'Booking added successfully']);
            if ($request->wantsJson()) {
            } else {
                $request->session()->flash('success', 'Booking Added Successfully!');
                return redirect()->route('booking.index');
            }
        } else {
            return response()->json(['errors' => $validator->errors()], 422);
            if ($request->wantsJson()) {
            } else {
                return redirect()->route('booking.create')->withErrors($validator)->withInput();
            }
        }
    }

    public function sendMailNotify($booking)
    {
        $email = $user_id->email; // Retrieve the email from the user record

        $data = [
            'title' => "Welcome to Your Function Junction",
            'subject' => "Booking Confirmation",
            'body' => "Thank you for booking with us. We are glad that we have been able to cherish your remarkable moment.",
            'user' => null, // Set user data to null since we are not using the logged-in user
            'booking' => $booking, // Pass the booking data to the email template
        ];

        try {
            Mail::to($booking->email)->send(new MailNotify($data));
        } catch (Exception $th) {
            // Handle the exception
        }
    }


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
