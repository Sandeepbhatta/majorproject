<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    // Existing methods...
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'oid' => 'required|string',
            'amt' => 'required|numeric',
            'refId' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Get the authenticated user's name
        $userName = Auth::user()->name;

        // Create a new invoice record in the database
        Invoice::create([
            'oid' => $request->oid,
            'amt' => $request->amt,
            'refId' => $request->refId,
            'user_name' => $userName, // Associate the authenticated user's name with the invoice
            // Add any other fields as needed
        ]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Data submitted successfully'], 200);
        } else {
            return redirect()->route('invoice.payment')->with('success', 'Data submitted successfully');
        }
    }

    public function payment(Request $request)
    {
        // Fetch the invoice data for the authenticated user
        $invoices = Invoice::all();
        return view('invoice.payment', compact('invoices'));
    }

    public function submitData(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'oid' => 'required|string',
            'amt' => 'required|numeric',
            'refId' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Get the authenticated user's name
        $userName = Auth::user()->name;

        // Create a new invoice record in the database
        Invoice::create([
            'oid' => $request->oid,
            'amt' => $request->amt,
            'refId' => $request->refId,
            'user_name' => $userName, // Associate the authenticated user's name with the invoice
            // Add any other fields as needed
        ]);
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Data submitted successfully'], 200);
        } else {
            return redirect()->route('payment')->with('success', 'Data submitted successfully');
        }        
        // Return a JSON response indicating the success of the data submission
    }
}

// react ma 
// 1. start re end wala form hunxa
// 2 fill up garera button click garda bookingExists api ma janxa
// 3 response ma available aayo vane matra proceedPayment api ma janxa
// 4. esewa bata pay vaisakexi verifyPayment api ma redirect gardinxa 