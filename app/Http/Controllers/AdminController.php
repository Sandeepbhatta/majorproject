<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
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
            return redirect()->route('admin.dashboard')->with('error','admin login successfully');
         }else{
                return back()->with('error','invalid email or password');
            }
    }//end method
    public function AdminLogout(){
        Auth::guard('admin')->logout();
        return  redirect()->route('login_form')->with('error','admin logout successfully');
    }//end method
}

