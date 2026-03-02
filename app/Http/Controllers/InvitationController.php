<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Colocation;
use Illuminate\Http\Request;
use App\Notifications\ColocationInvitation;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function store(Request $request, Colocation $colocation)
    {
        if ($colocation->owner_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'email' => 'required|email',
        ]);

        $invitation = Invitation::create([
            'colocation_id' => $colocation->id,
            'email' => $request->email,
            'token' => Str::uuid()->toString(),
            'status' => 'pending',
        ]);
        
        Notification::route('mail', $request->email)
            ->notify(new ColocationInvitation($invitation));

        return back()->with('success', 'Invitation envoyée avec succès.');
    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)
            ->where('status', 'pending')
            ->firstOrFail();

        if (!Auth::check()) {
            return redirect()->route('register', ['email' => $invitation->email])
                ->with('info', 'Veuillez créer un compte pour accepter l\'invitation.');
        }

        if ($invitation->email !== Auth::user()->email) {
            return redirect()->route('dashboard')
                ->withErrors('Cette invitation ne correspond pas à votre email.');
        }

        $hasActive = Auth::user()->memberships()
            ->whereNull('left_at')
            ->exists();

        if ($hasActive) {
            return redirect()->route('dashboard')
                ->withErrors('Vous avez déjà une colocation active.');
        }

        $invitation->colocation->memberships()->create([
            'user_id' => Auth::id(),
            'role' => 'member',
            'joined_at' => now(),
            'status' => 'active',
        ]);

        $invitation->delete();

        return redirect()->route('colocations.show', $invitation->colocation)
            ->with('success', 'Invitation acceptée avec succès !');
    }
}