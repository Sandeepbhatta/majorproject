<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use Auth;
use App\Models\Admin;
use Carbon\Carbon;



class AdminController extends Controller
{
    //
    public function Index(){
        return view('admin.admin_login');
    }//end method


    public function Dashboard(){
        return view('admin.index');
    }//end method

    public function Login(Request $request){
        // dd($request->all());
         $check = $request->all();
         if(auth::guard('admin')->attempt(['email'=> $check['email'], 'password'=> $check['password']])){
            return redirect()->route('admin.dashboard')->with('error','superadmin login successfully');
         }else{
            $error = 'Invalid email or password';
            return view('admin.admin_login',compact('error'));
            }
    }//end method
    public function Logout(){
        Auth::guard('admin')->logout();
        return  redirect()->route('login_form')->with('error','logout successfully');
    }//end method
    public function Register(){
        // Auth::guard('admin')->logout();
        return  view('admin.admin_register');
    }//end method
    public function RegisterCreate(Request $request){
        // Auth::guard('admin')->logout();
        // dd($request->all());\
        $password = $request->password;
        Admin::insert([
            'name' => $request->user,
            'email'=> $request->email,
            'password'=> bcrypt($password),
            'created_at'=> Carbon::now(),
            'email_verified_at'=> Carbon::now(),
        ]);
        $error = 'account created successfully';
        return view('admin.admin_login',compact('error'));
        
    }//end method
}

