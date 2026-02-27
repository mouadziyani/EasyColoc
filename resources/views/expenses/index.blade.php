@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Dépenses de {{ $colocation->name }}</h1>

    <a href="{{ route('colocations.expenses.create', $colocation) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Ajouter une dépense
    </a>

    <table class="min-w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Titre</th>
                <th class="px-4 py-2">Montant</th>
                <th class="px-4 py-2">Catégorie</th>
                <th class="px-4 py-2">Payeur</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($expenses as $expense)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $expense->title }}</td>
                <td class="px-4 py-2">{{ number_format($expense->amount, 2) }} MAD</td>
                <td class="px-4 py-2">{{ $expense->category?->name ?? 'Aucune' }}</td>
                <td class="px-4 py-2">{{ $expense->payer->name }}</td>
                <td class="px-4 py-2">{{ $expense->date->format('d/m/Y') }}</td>
                <td class="px-4 py-2 space-x-2">
                    <a href="{{ route('colocations.expenses.edit', [$colocation, $expense]) }}" class="text-blue-500">Éditer</a>
                    <form action="{{ route('colocations.expenses.destroy', [$colocation, $expense]) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500" onclick="return confirm('Supprimer cette dépense ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-2 text-center">Aucune dépense</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection