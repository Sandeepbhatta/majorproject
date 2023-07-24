<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Package;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; 

use Illuminate\Support\Collection;

use Auth;

class RatingController extends Controller
{
    public function index(Request $request)
    {
        $packages = Package::all(); 
        // Retrieve all packages from the database
        
        // Calculate the average rating for each package and store it in an associative array
        $averageRatingsByPackage = [];
        foreach ($packages as $package) {
            $averageRatingByPackage = Rating::where('package_id', $package->id)->avg('rating');
            $averageRatingsByPackage[$package->id] = $averageRatingByPackage ?? 0;
        }
        
        $ratings = Rating::all();
        // Return the JSON response with average ratings for each package
        if ($request->expectsJson()) {
            return response()->json([
                'averageRatingsByPackage' => $averageRatingsByPackage,
            ]);
        } else {
            return view('rating.index', compact( 'packages', 'averageRatingsByPackage'));
        }
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string',
            'package_id' => 'required|exists:packages,id',
        ]);
        
        $user_id = Auth::guard('admin')->user()->id;
        $packageId = $request->input('package_id');
        
    
        // Check if the user has already rated this package
        $existingRating = Rating::where('user_id', $user_id)->where('package_id', $packageId)->first();
    
        if ($existingRating) {
            // User has already rated this package, update their rating instead
            $existingRating->update([
                'rating' => $request->input('rating'),
                'comment' => $request->input('comment'),
            ]);
        } else {
            // User has not rated this package before, create a new rating
            Rating::create([
                'user_id' => $user_id,
                'package_id' => $packageId,
                'rating' => $request->input('rating'),
                'comment' => $request->input('comment'),
            ]);
        }
    
        // Calculate the average rating for each package and store it in an associative array
        $packages = Package::all();
        $averageRatingsByPackage = [];
        foreach ($packages as $package) {
            $averageRatingByPackage = Rating::where('package_id', $package->id)->avg('rating');
            $averageRatingsByPackage[$package->id] = $averageRatingByPackage ?? 0;
        }

    
        // Return the JSON response with average ratings for each package
        if ($request->expectsJson()) {
            return response()->json([
                'averageRatingsByPackage' => $averageRatingsByPackage,
            ]);
        } else {
            return view('rating.index', compact('packages', 'averageRatingsByPackage',));
        }
    }



    public function showForm()
    {
        $packages = Package::all();
        return view('rating.index', ['packages' => $packages]);
    }
    
}
