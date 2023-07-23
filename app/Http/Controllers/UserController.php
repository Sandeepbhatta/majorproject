<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rating; // Make sure to import the Rating model

use App\Http\Controllers\UserController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function NewClient(Request $request){
        $user = User::where('email', '=', $request->email)->first();
        if($user === null){  //ToDo List does not exist  
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->password = Hash::make($request->password);
            $user->save();        
                return response()->json(['message' => 'User Added Successfully!'], 201);
        
        } else{
            return response()->json(['message' => 'user already exist!'], 201);
        }
    }
    public function index()
    {
        $data['users'] = User::orderBy('id', 'asc')->paginate(5);

        return view('user.user', $data);
    }
    public function userdashboard()
    {
        return $user = Auth::user();
        $data['users'] = User::orderBy('id', 'asc')->paginate(5);

        return view('user.user', $data);
    }
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $token = Auth::attempt($credentials);
        
        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }
        

        $user = Auth::user();
        return response()->json([
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
    public function ratings()
    {
        // Get the authenticated user's ID
        $user_id = Auth::id();

        // Fetch ratings for the authenticated user from the database
        $ratings = Rating::where('user_id', $user_id)->get();

        // Return the ratings data as JSON
        return response()->json(['ratings' => $ratings]);
    }
    
}
