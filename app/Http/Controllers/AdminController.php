<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Form;
use Auth;
use App\Models\Admin;
use Carbon\Carbon;



class AdminController extends Controller
{
    //
    public function Index(){
        
            // return view('admin.index', );
        return view('admin.admin_login');
    }//end method


    public function Dashboard(){

        $admins = Admin::all(); // Replace 'Admin' with your appropriate model name
        $admins = Admin::orderBy('id', 'asc')->paginate(4);


        return view('admin.index', ['admins' => $admins]);
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
    public function RegisterCreate(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user' => ['required', 'string'],
        'email' => ['required', 'email', Rule::unique('admins')],
        'password' => ['required', 'string', 'confirmed'],
        'password_confirmation' => ['required', 'string'],
    
    ]);

    if ($validator->passes()) {
        $password = $request->password;
        $hashedPassword = Hash::make($password);
        
        Admin::create([
            'name' => $request->user,
            'email' => $request->email,
            'password' => $hashedPassword, // Hash the password
            'created_at' => Carbon::now(),
            'email_verified_at' => Carbon::now(),
        ]);
    
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Account added successfully']);
        } else {
            $request->session()->flash('success', 'Account Added Successfully!');
            return redirect()->route('admin.login');
        }
    } else {
        if ($request->wantsJson()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            return redirect()->route('admin.register')->withErrors($validator)->withInput();
        }
    }
}
    //end method
  
    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => 'required',
            'password' => ['required', 'string', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
            // 'status' => 'required',
            
        ]);

        if ($validator->passes()) {
            $admin = new Admin();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = bcrypt($request->password);;
            // $admin->confirm_password = $request->confirm_password;
            // $admin->status = $request->status;
            $admin->save();

            if ($request->wantsJson()) {
                return response()->json(['message' => 'Admin added successfully']);
            } else {
                $request->session()->flash('error', 'Admin Added Successfully!');
                return redirect()->route('admin.dashboard');
            }
        } else {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                return redirect()->route('admin.create')->withErrors($validator)->withInput();
            }
        }
    }

    public function edit(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        if ($request->wantsJson()) {
            return response()->json($admin);
        } else {
            return view('admin.edit', ['admin' => $admin]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => 'required',
            // 'status' => 'required',
        ]);

        if ($validator->passes()) {
            $admin = Admin::find($id);
            $admin->name = $request->name;
            $admin->email = $request->email;
            // $admin->status = $request->status;
            $admin->save();

            if ($request->wantsJson()) {
                return response()->json(['message' => 'admin updated successfully']);
            } else {
                $request->session()->flash('success', 'admin Edited Successfully!');
                return redirect()->route('admin.dashboard');
            }
        } else {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                return redirect()->route('admin.edit', $id)->withErrors($validator)->withInput();
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Admin deleted successfully']);
        } else {
            return redirect()->route('admin.dashboard')->with('success', 'Admin Deleted Successfully');
        }
    }

}

