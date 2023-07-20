<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Rating; 
use App\Models\Package;



class RatingController extends Controller
{
    public function index(Request $request)
    {
        $ratings = Rating::all(); // Fetch all ratings from the database
        $averageRating = Rating::avg('rating'); // Calculate average rating

        return view('rating.index', compact('ratings', 'averageRating'));
    }
    public function store(Request $request)
    {
        $rating = new Rating;
        $rating->rating = $request->rating;
        $rating->comment = $request->comment;
        $rating->package_id = $request->id;
        $rating->user_id = auth()->user()->id;
        $rating->save();

        // Retrieve the package based on the package_id
        $package = Package::find($request->id);

        return response()->json([
            'success' => true,
            'message' => 'Rating submitted successfully.',
            'averageRating' => $averageRating,
            'package' => $request->id
        ], Response::HTTP_OK);
    }
}

