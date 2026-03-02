<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $colocation->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Main card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Colocation details -->
                <div class="mb-6">
                    <p><strong>Description:</strong> {{ $colocation->description ?? '-' }}</p>
                    <p><strong>Adresse:</strong> {{ $colocation->address }}</p>
                    <p><strong>Propriétaire:</strong> {{ $colocation->owner->name }}</p>
                </div>

                <!-- Action buttons -->
                <div class="flex flex-wrap gap-3 mb-6">
                    <a href="{{ route('colocations.expenses.create', $colocation) }}" 
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                        Créer une dépense
                    </a>
                   <a href="" class="bg-blue-500 text-black px-4 py-2 rounded">
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

                <!-- Members section -->
                <div class="mb-6">
                    <h3 class="font-semibold text-gray-700 mb-2">Membres</h3>
                    <ul class="list-disc list-inside text-gray-600">
                        @forelse($colocation->members as $member)
                            <li>{{ $member->name }} ({{ $member->pivot->role ?? 'Membre' }})</li>
                        @empty
                            <li>Aucun membre pour cette colocation.</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Expenses section -->
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Dépenses</h3>

                        <ul class="divide-y divide-gray-200">

                                <li class="py-2 flex justify-between">
                                    <div>
                                        <span class="font-medium"></span> 
                                        - <span class="text-gray-500"> MAD</span>
                                    </div>
                                    <span class="text-sm text-gray-400"></span>
                                </li>
                        </ul>

                        <p class="text-gray-500">Aucune dépense pour le moment.</p>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>