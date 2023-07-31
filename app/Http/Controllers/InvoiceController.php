<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Invoice;
use App\Models\User;

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
        // Auth::guard('api')->user()->name;
        // return Auth::user();
        $user = Auth::guard('api')->user();
$userId = $user->id;
        // Create a new invoice record in the database
        Invoice::create([
            'oid' => $request->oid,
            'amt' => $request->amt,
            'refId' => $request->refId,
            'user_id' => $userId, // Pass the user_id obtained from the authenticated user

            // 'user_name' => $userName, // Associate the authenticated user's name with the invoice
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
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        $validator = Validator::make($request->all(), [
            'oid' => 'required|string',
            'amt' => 'required|numeric',
            'refId' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Get the authenticated user
        $user = Auth::guard('api')->user();
$userId = $user->id;
        // $userEmail = $user->email; // Retrieve the user's email


        // Get the authenticated user's name
        // $userId = User::where('email', $request->email)->first()->id;
        // Auth::guard('api')->user()->name;

        // $userName = Auth::user()->name;

        $url = "https://uat.esewa.com.np/epay/transrec";
        $data = [
            'amt' => $request->amt,
            'rid' => $request->refId,
            'pid' => $request->oid,
            'scd' => 'EPAYTEST',
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        $xml = simplexml_load_string($response);

        // Extract the value of the <response_code> element
        $responseCode = $xml->response_code;
        // return $responseCode;
        if($responseCode == 'failure'){
            return response()->json(['message' => 'Payment Failed'], 400);
        }

        // Save data to the database
        $invoice = Invoice::create([
            'oid' => $request->oid,
            'amt' => $request->amt,
            'refId' => $request->refId,
            'user_id' => $userId, // Pass the user_id obtained from the authenticated user

            // 'user_id' => $userId,
            // Add any other fields as needed
        ]);
        // return $invoice;

        return response()->json([
            'message' => 'Payment Successful',
            'data' => $invoice, 
            'user_id' => $userId, // Send the user's ID in the response
            // save it to local storage
        ], 200);
        
        
    }
}  
    

