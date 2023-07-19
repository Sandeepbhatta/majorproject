<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\UserController;

class UserController extends Controller
{
    public function NewClient(Request $request){
        $user = User::where('user', '=', $request->input('user'))->first();
        
        if($user === null){  //ToDo List does not exist  
            $user = new user;
            $user->user = $request->user;
            $user->save();                          
            return response()->json(['message' => 'New To-Do Added Successfully'], 201);
        } else {
            return response()->json(['error' => 'To-Do Already Exists'], 409);
        }
    }
    public function index()
    {
        $data['users'] = User::orderBy('id', 'asc')->paginate(5);

        return view('user.user', $data);
    }
    
}
