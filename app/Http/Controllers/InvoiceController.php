<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;


class InvoiceController extends Controller
{
    // public function index(Request $request)
    // {
    //     return view('invoice.payment');
    // }

    public function initiatePayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:10', // Minimum transaction amount is 10
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        

        $amount = (int)($request->amount * 100); // Convert amount to paisa (Khalti API requires paisa)
        $config = [
            'public_key' => config('app.khalti_public_key'),
            'amount' => $amount,
            'product_identity' => '1234567890',
            'product_name' => 'Product Name',
            'product_url' => 'https://example.com/product-url',
        ];

        $response = $this->sendPaymentRequest($config);

        // Save payment details in the database
        if ($response && $response['token']) {
            DB::table('payments')->insert([
                'transaction_id' => $response['token'],
                'amount' => $amount,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json($response);
    }

    public function khaltiWebhook(Request $request)
    {
        try {
            // Get the webhook data from the request
            $webhookData = $request->all();

            Log::info('Khalti Webhook Data:', $webhookData);

            if ($webhookData['state'] === 'Completed') {
                // Update the payment status in the database based on the webhook data
                DB::table('payments')->where('transaction_id', $webhookData['idx'])->update(['status' => 'success']);

                return response()->json(['status' => 'success']);
            } else {
                // Handle other webhook states if needed
                return response()->json(['status' => 'error']);
            }
        } catch (\Exception $e) {
            Log::error('Error processing Khalti webhook: ' . $e->getMessage());
            return response()->json(['status' => 'error']);
        }
    }

    
}