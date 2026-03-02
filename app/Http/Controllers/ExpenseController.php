<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Colocation;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    private function checkMembership(Colocation $colocation)
    {
        if (!$colocation->members()->where('users.id', Auth::id())->exists()) {
            abort(403, 'Access denied. You are not a member of this colocation.');
        }
    }

    public function index(Colocation $colocation)
    {
        $this->checkMembership($colocation);

        $expenses = $colocation->expenses()
            ->with(['category', 'payer'])
            ->latest()
            ->get();

        return view('expenses.index', compact('colocation', 'expenses'));
    }

    public function create(Colocation $colocation)
    {
        $this->checkMembership($colocation);

        $categories = Category::all();

        return view('expenses.create', compact('colocation', 'categories'));
    }

    public function store(Request $request, Colocation $colocation)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'category_id' => 'nullable',
            'paid_by' => 'integer',
            'date' => 'required|date',
            ]);
            
            
            $validated['colocation_id'] = $colocation->id;
            $validated['paid_by'] = auth()->user()->id;
            
            // dd($validated);
        Expense::create($validated);

        return redirect()
            ->route('colocations.show', $colocation)
            ->with('success', 'Dépense ajoutée avec succès !');
    }

    public function show(Colocation $colocation, Expense $expense)
    {
        $this->checkMembership($colocation);

        return view('expenses.show', compact('colocation', 'expense'));
    }

    public function edit(Colocation $colocation, Expense $expense)
    {
        $this->checkMembership($colocation);

        $categories = Category::all();

        return view('expenses.edit', compact('colocation', 'expense', 'categories'));
    }

    public function update(Request $request, Colocation $colocation, Expense $expense)
    {
        $this->checkMembership($colocation);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'category_id' => 'nullable|exists:categories,id',
            'paid_by' => 'required|exists:users,id',
            'date' => 'required|date',
        ]);

        $expense->update($validated);

        return redirect()
            ->route('colocations.show', $colocation)
            ->with('success', 'Dépense mise à jour avec succès !');
    }

    public function destroy(Colocation $colocation, Expense $expense)
    {
        $this->checkMembership($colocation);

        $expense->delete();

        return redirect()
            ->route('colocations.show', $colocation)
            ->with('success', 'Dépense supprimée avec succès !');
    }
    public function markAsPaid(Colocation $colocation, Expense $expense)
    {
        if (auth()->id() !== $colocation->owner_id) {
            abort(403, 'Unauthorized action.');
        }

        $expense->update([
            'is_paid' => true,
        ]);

        return redirect()->back()->with('success', 'Dépense marquée comme payée avec succès!');
    }
}