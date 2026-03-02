<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Lister toutes les colocations dyal user
    public function index()
    {
        $colocations = Auth::user()->colocations()->latest()->get();
        return view('colocations.index', compact('colocations'));
    }

    // Form creation
    public function create()
    {
        // Vérifier si l'utilisateur est déjà membre
        if (Auth::user()->memberships()->exists()) {
            return redirect()->route('colocations.index')
                ->withErrors('Vous êtes déjà membre d’une colocation.');
        }

        return view('colocations.create');
    }

    // Store new colocation
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

        // Add owner as member
        $colocation->memberships()->create([
            'user_id' => Auth::id(),
            'role' => 'owner',
            'joined_at' => now(),
        ]);

        return redirect()->route('colocations.show', $colocation)
            ->with('success', 'Colocation créée avec succès !');
    }

    // Show colocation
    public function show(Colocation $colocation)
    {
        if (!$colocation->members()->where('users.id', Auth::id())->exists()) {
            abort(403, 'Accès refusé.');
        }

        $colocation->load(['members', 'owner']);
        return view('colocations.show', compact('colocation'));
    }

    // Edit colocation
    public function edit(Colocation $colocation)
    {
        if ($colocation->owner_id !== Auth::id()) {
            abort(403, 'Seul le propriétaire peut modifier.');
        }

        return view('colocations.edit', compact('colocation'));
    }

    // Update colocation
    public function update(Request $request, Colocation $colocation)
    {
        if ($colocation->owner_id !== Auth::id()) {
            abort(403, 'Seul le propriétaire peut modifier.');
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

    // Delete colocation
    public function destroy(Colocation $colocation)
    {
        if ($colocation->owner_id !== Auth::id()) {
            abort(403, 'Seul le propriétaire peut supprimer.');
        }

        $colocation->delete();

        return redirect()->route('colocations.index')
            ->with('success', 'Colocation supprimée avec succès.');
    }
}