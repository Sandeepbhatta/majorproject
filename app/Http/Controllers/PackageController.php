<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function index(){
        $package = Package::orderBy('id','Asc')->paginate(2);

        return view('package.package',['packages'=> $package]);
    }
    public function create()
    {
        return view('package.create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string'],
            'price' => ['required',],
            // 'discount' => 'required',
            'description' => 'required',
            'features' => 'required',
            'image' => 'required',
        ]);
        if($validator->passes()){
            // echo "success";
            $package = new Package();
            $package -> name = $request->name;
            $package -> price = $request->price;
            $package -> discount = $request->discount;
            $package -> description = $request->description;
            $package -> features = $request->features;
            $package -> image = $request->image;
            $package -> save();
            $request->session()->flash('success','Package Added Successfully!');
            return redirect()->route('package.index');
        }else{
            return redirect()->route('package.create')->withErrors($validator)->withInput();
        }
    }
    public function edit($id){
        $package=Package::findorfail($id);
        // if(!$package){
        //     abort('404');
        // }

        return view('package.edit',['package'=>$package]);
    }
    public function update($id, Request $request){
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string'],
            'price' => ['required',],
            // 'discount' => 'required',
            'description' => 'required',
            'features' => 'required',
            'image' => 'required',
        ]);
        if($validator->passes()){
            // echo "success";
            $package = Package::find($id);
            $$package = new Package();
            $package -> name = $request->name;
            $package -> price = $request->price;
            $package -> discount = $request->discount;
            $package -> description = $request->description;
            $package -> features = $request->features;
            $package -> image = $request->image;
            $package -> save();
            $request->session()->flash('success','Package Edited Successfully!');
            return redirect()->route('package.index');
        }else{
            return redirect()->route('package.edit',$id)->withErrors($validator)->withInput();
        }

    }
    public function destroy($id, Request $request)
    {
        $package = Package::findOrfail($id);
        $package->delete();
        //File::delete(public_path().'/uploads/package'.$package->image);
        // $request->session()->flash('success','package Deleted successfully');
        return redirect()->route('package.index')
                        ->with('success','package deleted successfully');
    }
}
