<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Colocation;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function store(Request $request, Colocation $colocation)
    {
        $validated = $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
        ]);

        Payment::create([
            'colocation_id' => $colocation->id,
            'sender_id' => $validated['sender_id'],
            'receiver_id' => $validated['receiver_id'],
            'amount' => $validated['amount'],
        ]);

        return redirect()->back()->with('success', 'Paiement enregistré!');
    }
}