<?php

namespace App\Http\Controllers;
use App\Models\CustomizePackage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;



use Illuminate\Http\Request;

class CustomizePackageController extends Controller
{
    //
    public function index(Request $request)
        {
            $customizePackages = CustomizePackage::orderBy('id', 'asc')->paginate(5);

            if ($request->wantsJson()) {
                return response()->json($customizePackages);
            } else {
                return view('customepackage.customepackage', compact('customizePackages'));
            }
        }

        public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable',

            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $images[] = $imageName;
            }

            $customPackage = new CustomizePackage();
            $customPackage->name = $request->input('name'); // Add this line to set the name
            $customPackage->images = json_encode($images);
            $customPackage->save();

            return response()->json(['message' => 'Images uploaded successfully!']);
        }

        return response()->json(['message' => 'No images found!'], 400);
    }
    public function destroy(Request $request, $id)
    {
        $customizePackage = CustomizePackage::findOrFail($id);
        $customizePackage->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'customizePackage deleted successfully']);
        } else {
            return redirect()->route('customepackage.customepackage')->with('success', 'customizePackage deleted successfully');
        }
    }
}
