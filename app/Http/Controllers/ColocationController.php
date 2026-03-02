<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ColocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $colocations = Auth::user()->colocations()->latest()->get();
        return view('colocations.index', compact('colocations'));
    }

    public function create()
    {
        if (Auth::user()->memberships()->exists()) {
            return redirect()->route('colocations.index')
                ->withErrors('Vous êtes déjà membre d’une colocation.');
        }

        return view('colocations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
        ]);

        if (Auth::user()->memberships()->exists()) {
            return back()->withErrors('Vous êtes déjà membre d’une colocation.');
        }

        $colocation = Colocation::create([
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'owner_id' => Auth::id(),
        ]);

        $colocation->memberships()->create([
            'user_id' => Auth::id(),
            'role' => 'owner',
            'joined_at' => now(),
        ]);

        return redirect()->route('colocations.show', $colocation)
            ->with('success', 'Colocation créée avec succès !');
    }

    public function show(Colocation $colocation)
    {
        if (!$colocation->members()->where('users.id', Auth::id())->exists()) {
            abort(403, 'Accès refusé.');
        }

        $colocation->load(['members', 'owner', 'expenses.category', 'expenses.payer']);

        $totalExpenses = $colocation->expenses()->sum('amount');
        $memberCount = $colocation->members()->count();
        $individualShare = $memberCount > 0 ? $totalExpenses / $memberCount : 0;

        $memberBalances = [];
        foreach ($colocation->members as $member) {
            $paid = $colocation->expenses()->where('paid_by', $member->id)->sum('amount');
            
            $balance = $paid - $individualShare;

            $memberBalances[] = [
                'id' => $member->id,
                'name' => $member->name,
                'paid' => $paid,
                'balance' => $balance,
            ];
        }

        $debtsSettlement = [];
        $debtors = array_filter($memberBalances, fn($b) => $b['balance'] < 0);
        $creditors = array_filter($memberBalances, fn($b) => $b['balance'] > 0);

        foreach ($debtors as $debtorData) {
            $amountToPay = abs($debtorData['balance']);
            
            foreach ($creditors as &$creditorData) {
                if ($amountToPay == 0) break;
                if ($creditorData['balance'] <= 0) continue;

                $pay = min($amountToPay, $creditorData['balance']);
                if ($pay > 0) {
                    $debtsSettlement[] = [
                        'from' => $debtorData['name'],
                        'from_id' => $debtorData['id'],
                        'to' => $creditorData['name'],
                        'to_id' => $creditorData['id'],
                        'amount' => $pay
                    ];
                    $amountToPay -= $pay;
                    $creditorData['balance'] -= $pay;
                }
            }
        }

        return view('colocations.show', compact('colocation', 'memberBalances', 'totalExpenses', 'debtsSettlement'));
    }

    public function edit(Colocation $colocation)
    {

        if ($colocation->owner_id !== Auth::id()) {
            abort(403, 'Seul le propriétaire peut modifier la colocation.');
        }

        return view('colocations.edit', compact('colocation'));
    }

    public function update(Request $request, Colocation $colocation)
    {

        if ($colocation->owner_id !== Auth::id()) {
            abort(403, 'Seul le propriétaire peut modifier la colocation.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
        ]);

        $colocation->update($request->only('name', 'description', 'address'));

        return redirect()->route('colocations.show', $colocation)
            ->with('success', 'Colocation mise à jour avec succès.');
    }

    public function destroy(Colocation $colocation)
    {

        if ($colocation->owner_id !== Auth::id()) {
            abort(403, 'Seul le propriétaire peut supprimer la colocation.');
        }

        $colocation->delete();

        return redirect()->route('colocations.index')
            ->with('success', 'Colocation supprimée avec succès.');
    }

    public function invite(Request $request, Colocation $colocation)
    {

        if ($colocation->owner_id !== Auth::id()) {
            abort(403, 'Seul le propriétaire peut inviter des membres.');
        }
        
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Cet utilisateur n\'existe pas dans notre système.'
        ]);
        
        $user = \App\Models\User::where('email', $request->email)->first();
        
        if ($colocation->members()->where('users.id', $user->id)->exists()) {
            return back()->withErrors(['email' => 'Cet utilisateur est déjà membre.']);
        }
        
        $colocation->members()->attach($user->id);

        return redirect()->back()->with('success', 'Utilisateur ajouté avec succès !');
    }

    public function leaveColocation(Request $request, $colocationId)
    {
        $user = auth()->user();
        
        if (!$user->memberships()->where('colocation_id', $colocationId)->exists()) {
            abort(403, 'Vous n\'êtes pas membre de cette colocation.');
        }

        $balance = $this->calculateUserBalance($user->id, $colocationId);

        if ($balance < 0) {
            $user->decrement('reputation', 1);
        } elseif ($balance == 0) {
            $user->increment('reputation', 1);
        }

        $user->memberships()
            ->where('colocation_id', $colocationId)
            ->update(['left_at' => now()]);

        return redirect()->route('dashboard')->with('success', 'Vous avez quitté la colocation.');
    }

    private function calculateUserBalance($userId, $colocationId)
    {
        $colocation = Colocation::findOrFail($colocationId);
        $totalExpenses = $colocation->expenses()->sum('amount');
        $memberCount = $colocation->members()->count();
        $individualShare = $memberCount > 0 ? $totalExpenses / $memberCount : 0;
        
        $paid = $colocation->expenses()->where('paid_by', $userId)->sum('amount');
        
        return $paid - $individualShare;
    }
}