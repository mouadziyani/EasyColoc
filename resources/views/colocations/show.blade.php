<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $colocation->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p><strong>Description:</strong> {{ $colocation->description }}</p>
                <p><strong>Adresse:</strong> {{ $colocation->address }}</p>
                <p><strong>Propriétaire:</strong> {{ $colocation->owner->name }}</p>

                <h3 class="mt-4 font-semibold">Membres</h3>
                <ul>
                    @forelse($colocation->members as $member)
                        <li>{{ $member->name }} ({{ $member->pivot->role ?? 'Membre' }})</li>
                    @empty
                        <li>Aucun membre pour cette colocation.</li>
                    @endforelse
                </ul>

                <div class="mt-4 space-x-2">
                    <a href="{{ route('colocations.edit', $colocation) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Éditer</a>
                    <form action="{{ route('colocations.destroy', $colocation) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>