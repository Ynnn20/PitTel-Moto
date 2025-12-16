<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Servis;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'servis_id' => 'required|exists:servis,id',
            'payment_method' => 'required|in:tunai,transfer,kartu',
        ]);

        $servis = Servis::findOrFail($request->servis_id);

        // Check if payment already exists
        $existingPayment = Payment::where('servis_id', $servis->id)->first();

        if ($existingPayment) {
            return back()->with('error', 'Pembayaran untuk servis ini sudah dilakukan');
        }

        // Create payment record
        $payment = Payment::create([
            'servis_id' => $servis->id,
            'amount' => $servis->biaya,
            'method' => $request->payment_method,
            'status' => 'confirmed',
            'payment_date' => now(),
        ]);

        // Update servis as paid
        $servis->update(['paid' => true]);

        return back()->with('success', 'Pembayaran berhasil dicatat. Terima kasih!');
    }

    public function receipt($servisId)
    {
        $payment = Payment::where('servis_id', $servisId)->firstOrFail();
        $servis = $payment->servis->load(['pelanggan', 'motor', 'mekanik']);

        return view('payment.receipt', compact('payment', 'servis'));
    }
}
