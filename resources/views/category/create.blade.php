<x-app-layout>
    <div class="min-h-screen bg-white text-[#1a1a1a] selection:bg-black selection:text-white">
        
        <div class="max-w-6xl mx-auto px-6 py-10 flex justify-between items-end border-b border-gray-100">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-gray-400 mb-2 font-semibold italic">05 — Catégories</p>
                <h1 class="text-5xl font-black tracking-tighter shadow-sm uppercase">Nouvelle<br>Catégorie<span class="text-indigo-600">.</span></h1>
            </div>
            <a href="{{ url()->previous() }}" class="text-sm font-medium hover:line-through transition-all">Retour</a>
        </div>

        <div class="max-w-3xl mx-auto px-6 py-20">
            
            @if(session('success'))
                <div class="mb-10 p-6 bg-green-50 border border-green-100 text-green-900 rounded-[2rem] font-medium text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('categories.store') }}" method="POST" class="space-y-12">
                @csrf

                <div class="relative group">
                    <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400 group-focus-within:text-black transition-colors">Nom de la catégorie</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                           placeholder="Ex: Loyer, Nourriture, Internet..."
                           class="w-full border-0 border-b border-gray-200 py-6 px-0 text-3xl font-light focus:ring-0 focus:border-black transition-all placeholder:text-gray-100 uppercase tracking-tighter"
                           required>
                    @error('name') <span class="text-xs text-red-600 mt-2 block font-mono italic">{{ $message }}</span> @enderror
                </div>

                <div class="pt-6">
                    <button type="submit" class="relative overflow-hidden bg-black text-white px-12 py-5 rounded-full group transition-all duration-500 hover:pr-16">
                        <span class="relative z-10 font-bold uppercase text-sm tracking-widest">Enregistrer</span>
                        <span class="absolute right-6 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-all duration-500 translate-x-4 group-hover:translate-x-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>