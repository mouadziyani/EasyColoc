<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Success message -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-lg">Mes Colocations</h3>
                        <a href="{{ route('colocations.create') }}" 
                           class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                            Créer une nouvelle colocation
                        </a>
                    </div>

                    @if($colocations->count())
                        <ul class="divide-y divide-gray-200">
                            @foreach($colocations as $colocation)
                                <li class="py-4 flex justify-between items-center">
                                    <div>
                                        <a href="{{ route('colocations.show', $colocation) }}" 
                                           class="text-blue-600 font-semibold hover:underline">
                                            {{ $colocation->name }}
                                        </a>
                                        <p class="text-sm text-gray-500">{{ $colocation->address }}</p>
                                    </div>
                                    <span class="text-sm text-gray-400">
                                        Propriétaire: {{ $colocation->owner->name }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">Vous ne faites partie d'aucune colocation pour le moment.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>