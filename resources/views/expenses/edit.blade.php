@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Modifier la dépense "{{ $expense->title }}"</h1>

    <form action="{{ route('colocations.expenses.update', [$colocation, $expense]) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-semibold">Titre</label>
            <input type="text" name="title" value="{{ $expense->title }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block font-semibold">Montant</label>
            <input type="number" step="0.01" name="amount" value="{{ $expense->amount }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block font-semibold">Catégorie</label>
            <select name="category_id" class="w-full border rounded p-2">
                <option value="">-- Aucune --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($expense->category_id == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-semibold">Payeur</label>
            <select name="paid_by" class="w-full border rounded p-2" required>
                @foreach ($colocation->members as $member)
                    <option value="{{ $member->id }}" @selected($expense->paid_by == $member->id)>{{ $member->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-semibold">Date</label>
            <input type="date" name="date" value="{{ $expense->date->format('Y-m-d') }}" class="w-full border rounded p-2" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Mettre à jour</button>
    </form>
</div>
@endsection