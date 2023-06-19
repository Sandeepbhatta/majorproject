<?php

namespace App\Http\Controllers;
use App\Models\Bookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    //
    public function index(){
        return view('booking.booking');
    }
    public function create()
    {
        return view('booking.create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string'],
            'date' => ['required', 'date'],
            'Payment' => 'required',
            'package' => 'required',
            'sdate' => 'required',
            'edate' => 'required',
        ]);
        if($validator->passes()){
            // echo "success";
            $booking = new Booking();
            $booking -> name = $request->name;
            $booking -> booking_date = $request->date;
            $booking -> price_status = $request->Payment;
            $booking -> booking_type = $request->package;
            $booking -> start_date = $request->sdate;
            $booking -> end_date = $request->edate;
            $booking -> save();
            $request->session()->flash('success','Booking Added Successfully!');
            return redirect()->route('booking.index');
        }else{
            return redirect()->route('booking.create')->withErrors($validator)->withInput();
        }
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
