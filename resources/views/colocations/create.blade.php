<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Créer une Colocation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('colocations.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200">Nom</label>
                        <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ old('name') }}">
                        @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200">Description</label>
                        <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200">Adresse</label>
                        <input type="text" name="address" class="w-full border rounded px-3 py-2" value="{{ old('address') }}">
                        @error('address') <p class="text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>