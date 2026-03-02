<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-500 leading-tight">
            Ajouter une dépense à {{ $colocation->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('colocations.expenses.store', $colocation) }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Titre -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Titre</label>
                        <input type="text" name="title" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md shadow-sm px-3 py-2" value="{{ old('title') }}" required>
                        @error('title') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Montant -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Montant</label>
                        <input type="number" step="0.01" name="amount" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md shadow-sm px-3 py-2" value="{{ old('amount') }}" required>
                        @error('amount') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Catégorie -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Catégorie</label>
                        <select name="category_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md shadow-sm px-3 py-2">
                            <option value="">-- Aucune --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror

                        <!-- Ajouter nouvelle catégorie -->
                        <div class="mt-2 flex gap-2">
                            <input type="text" name="new_category" placeholder="Nouvelle catégorie" class="flex-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md px-3 py-2">
                            <span class="text-gray-400 text-sm self-center">Si vous ajoutez une nouvelle catégorie, elle sera créée automatiquement.</span>
                        </div>
                    </div>

                    <!-- Payeur -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Payeur</label>
                        <select name="paid_by" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md shadow-sm px-3 py-2" required>
                            @foreach ($colocation->members as $member)
                                <option value="{{ $member->id }}" {{ old('paid_by') == $member->id ? 'selected' : '' }}>
                                    {{ $member->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('paid_by') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Date -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Date</label>
                        <input type="date" name="date" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md shadow-sm px-3 py-2" value="{{ old('date') }}" required>
                        @error('date') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded-md shadow-sm transition">
                        Ajouter
                    </button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>