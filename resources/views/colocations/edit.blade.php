<x-app-layout>
    <div class="min-h-screen bg-[#F9FAFB] text-[#1a1a1a] selection:bg-black selection:text-white">
        <div class="max-w-7xl mx-auto px-6 pt-10">
            
            <nav class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">
                <a href="{{ route('colocations.index') }}" class="hover:text-black transition-colors">Colocations</a>
                <span>/</span>
                <a href="{{ route('colocations.show', $colocation) }}" class="hover:text-black transition-colors">{{ $colocation->name }}</a>
                <span>/</span>
                <span class="text-black">Modifier</span>
            </nav>

            <div class="bg-white border border-gray-100 rounded-[2rem] p-6 md:p-10 shadow-sm">
                
                <h1 class="text-4xl md:text-5xl font-black tracking-tighter text-gray-900 uppercase italic leading-none mb-10">
                    Modifier la<span class="text-indigo-600">.</span><br>colocation
                </h1>
                
                <form action="{{ route('colocations.update', $colocation) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="text-xs text-gray-400 uppercase tracking-widest font-bold">Nom de la colocation</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $colocation->name) }}" required
                               class="mt-2 block w-full border-gray-200 rounded-xl focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-lg">
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="description" class="text-xs text-gray-400 uppercase tracking-widest font-bold">Description</label>
                        <textarea name="description" id="description" rows="4"
                                  class="mt-2 block w-full border-gray-200 rounded-xl focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-lg">{{ old('description', $colocation->description) }}</textarea>
                        @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="address" class="text-xs text-gray-400 uppercase tracking-widest font-bold">Adresse</label>
                        <input type="text" name="address" id="address" value="{{ old('address', $colocation->address) }}" required
                               class="mt-2 block w-full border-gray-200 rounded-xl focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-lg">
                        @error('address') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('colocations.show', $colocation) }}" class="text-sm text-gray-500 hover:text-gray-900 transition-colors">
                            Annuler
                        </a>
                        <button type="submit"
                                class="bg-black text-white px-8 py-4 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-all shadow-lg shadow-gray-200">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>