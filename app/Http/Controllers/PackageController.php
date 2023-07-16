<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $packages = Package::orderBy('id', 'asc')->paginate(2);
            return response()->json($packages);
        } else {
            $package = Package::orderBy('id', 'asc')->paginate(2);
            return view('package.package', ['packages' => $package]);
        }
    }

    public function create()
    {
        return view('package.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'price' => ['required'],
            'description' => 'required',
            'features' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->passes()) {
            $package = new Package();
            $package->name = $request->name;
            $package->price = $request->price;
            $package->discount = $request->discount;
            $package->description = $request->description;
            $package->features = implode(', ', $request->features);
            $package->save();

            if ($request->image) {
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time() . '.' . $ext;
                $request->image->move(public_path() . '/uploads/package/', $newFileName);
                $package->image = $newFileName;
                $package->save();
            }
                // get rating of the package

            $rating = Rating::with('user')->where('package_id',$id)->get()->toArray();


            if ($request->wantsJson()) {
                return response()->json(['message' => 'Package added successfully']);
            } else {
                $request->session()->flash('success', 'Package Added Successfully!');
                return redirect()->route('package.index')->with(Compact('rating'));
            }
        } else {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                return redirect()->route('package.create')->withErrors($validator)->withInput();
            }
        }
    }

    public function edit(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        if ($request->wantsJson()) {
            return response()->json($package);
        } else {
            return view('package.edit', ['package' => $package]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'price' => ['required'],
            'description' => 'required',
            'features' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->passes()) {
            $package = Package::find($id);
            $package->name = $request->name;
            $package->price = $request->price;
            $package->discount = $request->discount;
            $package->description = $request->description;
            $package->features = implode(', ', $request->features);
            $package->save();

            if ($request->image) {
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time() . '.' . $ext;
                $request->image->move(public_path() . '/uploads/package/', $newFileName);
                $package->image = $newFileName;
                $package->save();
            }

            if ($request->wantsJson()) {
                return response()->json(['message' => 'Package updated successfully']);
            } else {
                $request->session()->flash('success', 'Package Updated Successfully!');
                return redirect()->route('package.index');
            }
        } else {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                return redirect()->route('package.edit', $id)->withErrors($validator)->withInput();
            }
        }
    }
    

    public function destroy(Request $request, $id)
    {
        $package = Package::findOrFail($id);
        $package->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Package deleted successfully']);
        } else {
            return redirect()->route('package.index')->with('success', 'Package deleted successfully');
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = Package::where('name', 'like', '%' . $query . '%')->get();

        if ($request->wantsJson()) {
            return response()->json($results);
        } else {
            return view('search.results', ['results' => $results]);
        }
    }
}
