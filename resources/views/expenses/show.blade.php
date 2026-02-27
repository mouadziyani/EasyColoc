@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Détails de la dépense "{{ $expense->title }}"</h1>

    <ul class="space-y-2">
        <li><strong>Montant :</strong> {{ number_format($expense->amount, 2) }} MAD</li>
        <li><strong>Catégorie :</strong> {{ $expense->category?->name ?? 'Aucune' }}</li>
        <li><strong>Payeur :</strong> {{ $expense->payer->name }}</li>
        <li><strong>Date :</strong> {{ $expense->date->format('d/m/Y') }}</li>
    </ul>

    <a href="{{ route('colocations.expenses.index', $colocation) }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
        Retour aux dépenses
    </a>
</div>
@endsection