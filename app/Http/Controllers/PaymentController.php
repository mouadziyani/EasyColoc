<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'payer_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'colocation_id' => 'required|exists:colocations,id',
        ]);

        Payment::create($validated);

        return back()->with('success', 'Paiement enregistré avec succès.');
    }
}