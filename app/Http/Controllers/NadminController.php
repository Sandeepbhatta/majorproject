<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NadminController extends Controller
{
    public function NadminIndex(){

        return view('nadmin.nadmin_login');
    }//end method

    public function NadminDashboard(){

        return view('nadmin.index');
    }//end method

    public function NadminLogin(Request $request){
        // dd($request->all());
         $check = $request->all();
         if(auth::guard('nadmin')->attempt(['email'=> $check['email'], 'password'=> $check['password']])){
            return redirect()->route('nadmin.dashboard')->with('error','admin login successfully');
         }else{
                return back()->with('error','invalid email or password');
            }
    }//end method

    public function NadminLogout(){
        Auth::guard('nadmin')->logout();
        return  redirect()->route('nadmin_login_form')->with('error','logout successfully');
    }//end method
}
