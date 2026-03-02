<x-app-layout>
    <div class="min-h-screen bg-white text-[#1a1a1a] selection:bg-black selection:text-white">
        
        <div class="max-w-6xl mx-auto px-6 py-10 flex justify-between items-end border-b border-gray-100">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-gray-400 mb-2 font-semibold italic">04 — Dépenses</p>
                <h1 class="text-5xl font-black tracking-tighter shadow-sm uppercase">Nouvelle<br>Dépense<span class="text-indigo-600">.</span></h1>
            </div>
            <a href="{{ url()->previous() }}" class="text-sm font-medium hover:line-through transition-all">Retour</a>
        </div>

        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-16 py-16">
            
            <div class="lg:col-span-4 border-t-2 border-black pt-8">
                <p class="text-lg leading-relaxed font-medium">
                    Ajoutez une dépense pour <span class="font-black italic">{{ $colocation->name }}</span>.
                </p>
                <p class="text-sm text-gray-500 mt-4">Le montant sera automatiquement divisé entre les <span class="font-bold text-black">{{ $colocation->members->count() }}</span> membres.</p>
                <div class="mt-12 space-y-4 text-sm text-gray-500">
                    <p>● Titre clair</p>
                    <p>● Catégorie optionnelle</p>
                    <p>● Date précise</p>
                </div>
            </div>

            <div class="lg:col-span-8">
                <form action="{{ route('colocations.expenses.store', $colocation) }}" method="POST" class="space-y-12">
                    @csrf

                    <div class="relative group">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400 group-focus-within:text-black transition-colors">Nom de la dépense</label>
                        <input type="text" name="title" value="{{ old('title') }}" 
                               placeholder="Ex: Courses mensuelles, Internet..."
                               class="w-full border-0 border-b border-gray-200 py-6 px-0 text-3xl font-light focus:ring-0 focus:border-black transition-all placeholder:text-gray-100 uppercase tracking-tighter">
                        @error('title') <span class="text-xs text-red-600 mt-2 block font-mono italic">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div class="relative group">
                            <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400 group-focus-within:text-black">Montant (MAD)</label>
                            <div class="flex items-center border-b border-gray-200 group-focus-within:border-black transition-all">
                                <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" 
                                       placeholder="0.00"
                                       class="w-full border-0 py-4 px-0 focus:ring-0 text-3xl font-bold tracking-tighter">
                                <span class="text-gray-300">MAD</span>
                            </div>
                            @error('amount') <span class="text-xs text-red-600 mt-2 block font-mono italic">{{ $message }}</span> @enderror
                        </div>

                        <div class="relative group">
                            <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400 group-focus-within:text-black">Date</label>
                            <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" 
                                   class="w-full border-0 border-b border-gray-200 py-4 px-0 focus:ring-0 focus:border-black transition-all text-lg">
                            @error('date') <span class="text-xs text-red-600 mt-2 block font-mono italic">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <div class="relative group">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400 group-focus-within:text-black">Catégorie</label>
                        <select name="category_id" class="w-full border-0 border-b border-gray-200 py-4 px-0 focus:ring-0 focus:border-black transition-all text-lg bg-transparent">
                            <option value="" class="text-gray-400">Sélectionner une catégorie...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-xs text-red-600 mt-2 block font-mono italic">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-10">
                        <button type="submit" class="relative overflow-hidden bg-black text-white px-12 py-5 rounded-full group transition-all duration-500 hover:pr-16">
                            <span class="relative z-10 font-bold uppercase text-sm tracking-widest">Valider la dépense</span>
                            <span class="absolute right-6 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-all duration-500 translate-x-4 group-hover:translate-x-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>