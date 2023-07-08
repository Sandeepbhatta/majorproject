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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'price' => ['required',],
            'description' => 'required',
            'features' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->passes()) {
            // echo "success";
            $package = new Package();
            $package -> name = $request->name;
            $package -> price = $request->price;
            $package -> discount = $request->discount;
            $package -> description = $request->description;
            $package -> features = implode(', ', $request->features);
            $package -> save();
            //upload image here
            if ($request->image) {
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time() . '.' . $ext;
                $request->image->move(public_path() . '/uploads/package/', $newFileName);
                $package->image = $newFileName;
                $package->save();
            }
            // if ($request->hasFile('image')) {
            //     $imagePath = $request->file('image')->store('images', 'public');
        
                // Save the image path to the database or perform any other required actions
                //  $newFileName = time() . '.' . $ext;

                //  $package->image = $newFileName;
                // Return a response indicating success
            //     return response()->json(['message' => 'Image uploaded successfully', 'image_path' => $imagePath]);
            // }
        
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
            $package = new Package();
            $package -> name = $request->name;
            $package -> price = $request->price;
            $package -> discount = $request->discount;
            $package -> description = $request->description;
            $package -> features = $request->features;
            $package -> save();
            if ($request->$image){
                $ext = $request->image->getClientOriginalExtention();
                $newFileName = time().'.'.$ext;
                $request-> image->move(public_path().'/uploads/package/',$newFileName);
                $package -> image=$newFileName ;
                $package -> save();
            }
            $request->session()->flash('success','Package Added Successfully!');
            return redirect()->route('package.index');
        }else{
            return redirect()->route('package.edit')->withErrors($validator)->withInput();
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
