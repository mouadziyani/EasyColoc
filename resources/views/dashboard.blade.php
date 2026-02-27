<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card principale -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Colocations créées -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold">Mes colocations (Owner)</h3>
                    <p class="mt-2 text-gray-700 dark:text-gray-300 text-2xl">{{ auth()->user()->ownedColocations->count() }}</p>
                    <a href="{{ route('colocations.index') }}" class="text-blue-500 hover:underline mt-2 inline-block">Voir mes colocations</a>
                </div>
<br>
                <!-- Dépenses totales -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold">Total dépenses</h3>
                    <p class="mt-2 text-gray-700 dark:text-gray-300 text-2xl">
                        MAD
                    </p>
                    <a href="{{ route('expenses.index') }}" class="text-blue-500 hover:underline mt-2 inline-block">Voir toutes les dépenses</a>
                </div>
<br>
                <!-- Ajouter une colocation -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col justify-between">
                    <h3 class="text-lg font-bold">Nouvelle colocation</h3>
                    <a href="{{ route('colocations.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-4 text-center">Créer une colocation</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>