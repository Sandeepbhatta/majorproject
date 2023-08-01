<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArEventNavigation;
class ArEventNavigationController extends Controller
{
    //
    public function index()
    {
        $arEventNavigations = ArEventNavigation::all();
        return view('ar_event_navigation.index', compact('arEventNavigations'));
    }

    public function create()
    {
        return view('ar_event_navigation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string',
            'location' => 'required|string',
            'ar_navigation_url' => 'required|url',
        ]);

        ArEventNavigation::create($request->all());
        if ($request->wantsJson()) {
            return response()->json(['message' => 'ArEventNavigation added successfully']);
        } else {
            return redirect()->route('ar_event_navigation.index')->with('success', 'AR Event Navigation added successfully.');
        }
    }
    public function destroy(Request $request, $id)
    {
        $arEventNavigations = ArEventNavigation::findOrFail($id);
        $arEventNavigations->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'ArEventNavigation deleted successfully']);
        } else {
            return redirect()->route('ar_event_navigation.index')->with('success', 'ArEventNavigation deleted successfully');
        }
    }
}
