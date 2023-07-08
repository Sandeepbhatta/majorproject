<?php

namespace App\Http\Controllers;
use App\Models\Bookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    //
    public function index()
    {
        $dataReturn['bookings'] = Bookings::orderBy('id', 'asc')->paginate(2);
    
        // return response()->json($bookings);
        return view('booking.booking', $dataReturn);
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
            // Assign request values to booking model attributes
            $booking->name = $request->name;
            $booking->booking_date = $request->booking_date;
            $booking->price_status = $request->price_status;
            $booking->booking_type = $request->booking_type;
            $booking->start_date = $request->start_date;
            $booking->end_date = $request->end_date;
            $booking->save();
    
            return response()->json(['message' => 'Booking created successfully'], 201);
        } else {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    }
    
    public function show($id)
    {
        $booking = Bookings::find($id);
    
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }
    
        return response()->json($booking);
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
    
            if (!$booking) {
                return response()->json(['message' => 'Booking not found'], 404);
            }
    
            // Assign request values to booking model attributes
            $booking->name = $request->name;
            $booking->booking_date = $request->booking_date;
            $booking->price_status = $request->price_status;
            $booking->booking_type = $request->booking_type;
            $booking->start_date = $request->start_date;
            $booking->end_date = $request->end_date;
            $booking->save();
    
            return response()->json(['message' => 'Booking updated successfully']);
        } else {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    }
    
    public function destroy($id)
    {
        $booking = Bookings::find($id);
    
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }
    
        $booking->delete();
    
        return response()->json(['message' => 'Booking deleted successfully']);
    }
    
    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //     ]);
    
    //     User::create($request->all());
     
    //     return redirect()->route('user.index')
    //                     ->with('success','User created successfully.');
    // }
     
    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\User  $user
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(User $user)
    // {
    //     return view('user.show',compact('user'));
    // } 
     
    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\User  $user
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(User $user)
    // {
    //     return view('user.edit',compact('user'));
    // }
    
    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\User  $user
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, User $user)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //     ]);
    
    //     $user->update($request->all());
    
    //     return redirect()->route('users.index')
    //                     ->with('success','User updated successfully');
    // }
    
    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\User  $user
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(User $user)
    // {
    //     $user->delete();
    
    //     return redirect()->route('user.index')
    //                     ->with('success','User deleted successfully');
    // }

}
