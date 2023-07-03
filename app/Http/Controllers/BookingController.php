<?php

namespace App\Http\Controllers;
use App\Models\Bookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    //
    public function index(){
        $booking = Bookings::orderBy('id','Asc')->paginate(2);

        return view('booking.booking',['bookings'=> $booking]);
    }
    public function create()
    {
        return view('booking.create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string'],
            'booking_date' => ['required', 'date'],
            'price_status' => 'required',
            'booking_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        if($validator->passes()){
            // echo "success";
            $booking = new Bookings();
            $booking -> name = $request->name;
            $booking -> booking_date = $request->booking_date;
            $booking -> price_status = $request->price_status;
            $booking -> booking_type = $request->booking_type;
            $booking -> start_date = $request->start_date;
            $booking -> end_date = $request->end_date;
            $booking -> save();
            $request->session()->flash('success','Booking Added Successfully!');
            return redirect()->route('booking.index');
        }else{
            return redirect()->route('booking.create')->withErrors($validator)->withInput();
        }
    }
    public function edit($id){
        $booking=Bookings::findorfail($id);
        // if(!$booking){
        //     abort('404');
        // }

        return view('booking.edit',['booking'=>$booking]);
    }
    public function update($id, Request $request){
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string'],
            'booking_date' => ['required', 'date'],
            'price_status' => 'required',
            'booking_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        if($validator->passes()){
            // echo "success";
            $booking = Bookings::find($id);
            $booking -> name = $request->name;
            $booking -> booking_date = $request->booking_date;
            $booking -> price_status = $request->price_status;
            $booking -> booking_type = $request->booking_type;
            $booking -> start_date = $request->start_date;
            $booking -> end_date = $request->end_date;
            $booking -> save();
            $request->session()->flash('success','Booking Edited Successfully!');
            return redirect()->route('booking.index');
        }else{
            return redirect()->route('booking.edit',$id)->withErrors($validator)->withInput();
        }

    }
    public function destroy($id, Request $request)
    {
        $booking = Bookings::findOrfail($id);
        $booking->delete();
        //File::delete(public_path().'/uploads/booking'.$booking->image);
        // $request->session()->flash('success','Booking Deleted successfully');
        return redirect()->route('booking.index')
                        ->with('success','Booking deleted successfully');
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
