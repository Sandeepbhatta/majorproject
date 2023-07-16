<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Session;

class RatingsController extends Controller
{
    public function create()
    {
        Session::put('page','ratings');
        $ratings=Rating::with(['user','package'])->get()->toArray();
        // dd($ratings);
        return view('ratings.create')->with(compact('ratings'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'integer'],
            'package_id' => ['required', 'integer'],
            'rating' => 'required',
            'review' => 'required',
        ]);

        if ($validator->passes()) {
            $rating = new Rating();
            $rating->user_id = $request->user_id;
            $rating->package_id = $request->package_id;
            $rating->rating = $request->rating;
            $rating->review = $request->review;
            $rating->save();

            if ($request->wantsJson()) {
                return response()->json(['message' => 'rating added successfully']);
            } else {
                $request->session()->flash('success', 'rating Added Successfully!');
                return redirect()->route('ratings.create');
            }
        } else {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                return redirect()->route('ratings.store')->withErrors($validator)->withInput();
            }
        }
    }
    public function addRating(){
        if($request->isMethod('post')){
            $data = $request->all();
            echo "<pre>";print_r($data);die;
            if(!Auth::check()){
                $message = "Login to rate this";
                session()->flash("error", $message );
                return redirect()->back();
            }
            if(!isset($data['rating'])||empty($data['rating'])){
                $message ="Please select number of star";
                session()->flash("error", $message );
                return redirect()->back();
            }
            $ratingCount= Rating::where(['user_id'=>Auth::user()->id,'package_id'=>$data['package_id']])->count();
            if($ratingCount>0){
            
                $message="Your rating already exists for this Package";
                Session::flash("warning",$message);
                return redirect()->back();
            }else{
                $rating = new Rating;
                $rating->user_id= Auth::User()->id ;
                $rating->package_id=$data['package_id'];
                $rating->review=$data['review'];
                $rating->rating=$data['rating'];
                $rating->save();
                $message="Thankyou for the rating";
                Session::flash("success",$message);
                return redirect()->back();

            }

        }

    }

    public function destroy(Request $request, $id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'rating deleted successfully']);
        } else {
            return redirect()->route('ratings.create')->with('success', 'rating deleted successfully');
        }
    }
}

