@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Ajouter une dépense à {{ $colocation->name }}</h1>

    <form action="{{ route('colocations.expenses.store', $colocation) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-semibold">Titre</label>
            <input type="text" name="title" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block font-semibold">Montant</label>
            <input type="number" step="0.01" name="amount" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block font-semibold">Catégorie</label>
            <select name="category_id" class="w-full border rounded p-2">
                <option value="">-- Aucune --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-semibold">Payeur</label>
            <select name="paid_by" class="w-full border rounded p-2" required>
                @foreach ($colocation->members as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-semibold">Date</label>
            <input type="date" name="date" class="w-full border rounded p-2" required>
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Ajouter</button>
    </form>
</div>
@endsection