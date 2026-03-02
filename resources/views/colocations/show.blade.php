<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-500 leading-tight">
            {{ $colocation->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Main card -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 space-y-6">

                <!-- Colocation details card -->
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                    <h3 class="font-semibold text-lg mb-2">Détails de la colocation</h3>
                    <p><strong>Description:</strong> {{ $colocation->description ?? '-' }}</p>
                    <p><strong>Adresse:</strong> {{ $colocation->address }}</p>
                    <p><strong>Propriétaire:</strong> {{ $colocation->owner->name }}</p>
                </div>

                <!-- Action buttons card -->
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('colocations.expenses.create', $colocation) }}" 
                       class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                        Créer une dépense
                    </a>
                    <a href="{{ route('categories.create') }}" 
                       class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
                        Créer une catégorie
                    </a>
                    <a href="#" class="px-4 py-2 bg-blue-200 text-black rounded hover:bg-blue-300 transition">
                        Inviter un membre
                    </a>
                    @if($colocation->owner_id === auth()->id())
                        <a href="{{ route('colocations.edit', $colocation) }}" 
                           class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                            Éditer
                        </a>
                        <form action="{{ route('colocations.destroy', $colocation) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                Supprimer
                            </button>
                        </form>
                    @endif
                </div>

                <!-- Members card -->
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                    <h3 class="font-semibold text-lg mb-2">Membres</h3>
                    <ul class="list-disc list-inside text-gray-600 dark:text-gray-200">
                        @forelse($colocation->members as $member)
                            <li>{{ $member->name }} ({{ $member->pivot->role ?? 'Membre' }})</li>
                        @empty
                            <li>Aucun membre pour cette colocation.</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Expenses card -->
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                    <h3 class="font-semibold text-lg mb-2">Dépenses</h3>

                    @if($colocation->expenses->count())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach($colocation->expenses as $expense)
                                <li class="py-2 flex justify-between items-center">
                                    <div>
                                        <span class="font-medium">{{ $expense->title }}</span> 
                                        - <span class="text-gray-500">{{ $expense->amount }} MAD</span>
                                        @if($expense->category)
                                            <span class="ml-2 text-sm text-gray-400">({{ $expense->category->name }})</span>
                                        @endif
                                    </div>
                                    <div class="flex gap-2">
                                        @if(auth()->id() === $colocation->owner_id)
                                            <a href="{{ route('expenses.edit', $expense) }}" 
                                               class="text-blue-500 hover:underline text-sm">Éditer</a>
                                            <form action="{{ route('expenses.destroy', $expense) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline text-sm">
                                                    Supprimer
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 mt-2">Aucune dépense pour le moment.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>