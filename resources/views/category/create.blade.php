<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Créer une catégorie</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">

                @if(session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Nom</label>
                        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                        @error('name') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Créer
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>