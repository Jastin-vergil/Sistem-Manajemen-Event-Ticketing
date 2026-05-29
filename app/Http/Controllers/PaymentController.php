<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        /*Validation*/

        $request->validate([
            'ticket_type' => 'required',
            'price' => 'required',
            'proof' => 'required|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        /*Upload Proof File*/

        $proofPath = $request->file('proof')->store(
            'payment_proofs',
            'public'
        );

        /*Example Data*/

        $paymentData = [
            'ticket_type' => $request->ticket_type,
            'price' => $request->price,
            'proof' => $proofPath,
        ];

        /*Return*/

        return back()->with(
            'success',
            'Payment uploaded successfully!'
        );
    }
}