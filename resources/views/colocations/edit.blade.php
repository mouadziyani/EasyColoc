<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mes Colocations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('colocations.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">
                Nouvelle Colocation
            </a>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($colocations->count())
                        <table class="w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Nom</th>
                                    <th class="px-4 py-2">Adresse</th>
                                    <th class="px-4 py-2">Propriétaire</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($colocations as $coloc)
                                <tr class="border-t">
                                    <td class="px-4 py-2">{{ $coloc->name }}</td>
                                    <td class="px-4 py-2">{{ $coloc->address }}</td>
                                    <td class="px-4 py-2">{{ $coloc->owner->name }}</td>
                                    <td class="px-4 py-2 space-x-2">
                                        <a href="{{ route('colocations.show', $coloc) }}" class="text-blue-500">Voir</a>
                                        <a href="{{ route('colocations.edit', $coloc) }}" class="text-yellow-500">Éditer</a>
                                        <form action="{{ route('colocations.destroy', $coloc) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Aucune colocation trouvée.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>