<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RatingsController extends Controller
{
    public function addRating(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'package_id' => 'required|integer',
                'rating' => 'required|integer',
                'review' => 'nullable|string',
            ]);

            if (!Auth::check()) {
                $message = "Login to rate this";
                session()->flash("error", $message);
                return redirect()->back();
            }

            $ratingCount = Rating::where([
                'user_id' => Auth::user()->id,
                'package_id' => $data['package_id']
            ])->count();

            if ($ratingCount > 0) {
                $message = "Your rating already exists for this package";
                Session::flash("warning", $message);
                return redirect()->back();
            }

            $rating = new Rating;
            $rating->user_id = Auth::user()->id;
            $rating->package_id = $data['package_id'];
            $rating->rating = $data['rating'];
            $rating->review = $data['review'];
            $rating->save();

            $message = "Thank you for the rating";
            Session::flash("success", $message);
            return redirect()->back();
        }

        return redirect()->back();
    }
}
