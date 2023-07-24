<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $categories = Category::orderBy('id', 'asc')->paginate(2);
            return response()->json($categories);
        } else {
            $category = Category::orderBy('id', 'asc')->paginate(2);
            return view('category.category', ['categories' => $category]);
        }
    }

    public function create()
    {
        return view('category.create');
    }

        public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->passes()) {
            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;

            // Handle the image upload
            if ($request->hasFile('image')) {
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time() . '.' . $ext;
                $request->image->move(public_path() . '/uploads/category/', $newFileName);
                $category->image = $newFileName;
            }
            

            $category->save();

            if ($request->wantsJson()) {
                return response()->json(['message' => 'Category added successfully']);
            } else {
                $request->session()->flash('success', 'Category Added Successfully!');
                return redirect()->route('category.index');
            }
        } else {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                return redirect()->route('category.create')->withErrors($validator)->withInput();
            }
        }
    }


    public function edit(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        if ($request->wantsJson()) {
            return response()->json($category);
        } else {
            return view('category.edit', ['category' => $category]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->passes()) {
            $category = Category::find($id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();

            if ($request->hasFile('image')) {
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time() . '.' . $ext;
                $request->image->move(public_path() . '/uploads/category/', $newFileName);
                $category->image = $newFileName;
            }
            

            if ($request->wantsJson()) {
                return response()->json(['message' => 'Category updated successfully']);
            } else {
                $request->session()->flash('success', 'Category Updated Successfully!');
                return redirect()->route('category.index');
            }
        } else {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                return redirect()->route('category.edit', $id)->withErrors($validator)->withInput();
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Category deleted successfully']);
        } else {
            return redirect()->route('category.index')->with('success', 'Category deleted successfully');
        }
    }

}
