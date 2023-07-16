<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;


class InvoiceController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $invoice = Invoice::orderBy('id', 'asc')->get();
            return response()->json($invoice);
        } else {
            $invoice = Invoice::orderBy('id', 'asc')->get();
            return view('invoice.payment', ['invoice' => $invoice]);
        }
    }
    public function verifyPayment(Request $request)
    {
        $token = $request ->token;
        # Prepare data for verification
        $args = http_build_query(array(
        'token' => $token,
        'amount'  => 100000
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $secret_key = config('app.khalti_secret_key');
        $headers = ['Authorization: Key $secret_key'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $response;
    }
    public function storePayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => ['required', 'integer'],
            'amount' => ['required', 'float'],           
        ]);
        if ($validator->passes()) {
            $invoice = new Invoice();
            $invoice->mobile_number = $request->mobile_number;
            $invoice->amount = $request->amount;
            $booking->save();

            if ($request->wantsJson()) {
                return response()->json(['message' => 'Invoice added successfully']);
            } 
            // else {
            //     $request->session()->flash('success', 'Invoice Added Successfully!');
            //     return redirect()->route('invoice.index');
            // }
        } else {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            //  else {
            //     return redirect()->route('invoice.create')->withErrors($validator)->withInput();
            // }
        }
    }
}   
