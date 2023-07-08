<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $bookings = Bookings::orderBy('id', 'asc')->paginate(2);
            return response()->json($bookings);
        } else {
            $booking = Bookings::orderBy('id', 'asc')->paginate(2);
            return view('booking.booking', ['bookings' => $booking]);
        }
    }

    public function create()
    {
        return view('booking.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'booking_date' => ['required', 'date'],
            'price_status' => 'required',
            'booking_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($validator->passes()) {
            $booking = new Bookings();
            $booking->name = $request->name;
            $booking->booking_date = $request->booking_date;
            $booking->price_status = $request->price_status;
            $booking->booking_type = $request->booking_type;
            $booking->start_date = $request->start_date;
            $booking->end_date = $request->end_date;
            $booking->save();

            if ($request->wantsJson()) {
                return response()->json(['message' => 'Booking added successfully']);
            } else {
                $request->session()->flash('success', 'Booking Added Successfully!');
                return redirect()->route('booking.index');
            }
        } else {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                return redirect()->route('booking.create')->withErrors($validator)->withInput();
            }
        }
    }

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
            'name' => ['required', 'string'],
            'booking_date' => ['required', 'date'],
            'price_status' => 'required',
            'booking_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($validator->passes()) {
            $booking = Bookings::find($id);
            $booking->name = $request->name;
            $booking->booking_date = $request->booking_date;
            $booking->price_status = $request->price_status;
            $booking->booking_type = $request->booking_type;
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
