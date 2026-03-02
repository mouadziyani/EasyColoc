<x-app-layout>
    <div class="min-h-screen bg-white text-[#1a1a1a] selection:bg-black selection:text-white">
        
        <div class="max-w-7xl mx-auto px-6 pt-16 pb-12 border-b border-gray-100">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-gray-400 mb-2 font-semibold italic">02 — Gestion</p>
                    <h1 class="text-6xl font-black tracking-tighter text-gray-900 uppercase leading-none">
                        Mes Espaces<span class="text-indigo-600">.</span>
                    </h1>
                </div>
                
                <a href="{{ route('colocations.create') }}" 
                   class="bg-black text-white px-8 py-4 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-all shadow-2xl shadow-gray-200">
                    + Nouvelle Coloc
                </a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-12">
            
            @if($colocations->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($colocations as $coloc)
                        <div class="group border border-gray-100 rounded-[2rem] p-8 hover:border-black transition-all duration-300 hover:shadow-2xl hover:shadow-gray-100 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start mb-6">
                                    <h3 class="text-2xl font-black uppercase tracking-tighter leading-none group-hover:text-indigo-600 transition-colors">
                                        {{ $coloc->name }}
                                    </h3>
                                    <span class="text-xs font-bold text-gray-300 group-hover:text-black">
                                        {{ $loop->iteration < 10 ? '0'.$loop->iteration : $loop->iteration }}
                                    </span>
                                </div>
                                
                                <p class="text-sm text-gray-500 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                    {{ $coloc->address }}
                                </p>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6 italic">
                                    Propriétaire: {{ $coloc->owner->name }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-6 border-t border-gray-100 mt-auto">
                                <a href="{{ route('colocations.show', $coloc) }}" class="text-xs font-black uppercase tracking-widest hover:text-indigo-600 transition-colors">
                                    Ouvrir
                                </a>
                                
                                <div class="flex gap-2">
                                    <a href="{{ route('colocations.edit', $coloc) }}" class="p-2 border border-gray-100 rounded-full hover:bg-gray-50 text-gray-400 hover:text-black">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('colocations.destroy', $coloc) }}" method="POST" onsubmit="return confirm('Confirmer la suppression?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 border border-gray-100 rounded-full hover:bg-gray-50 text-gray-400 hover:text-red-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-32 border-2 border-dashed border-gray-100 rounded-[3rem]">
                    <h3 class="text-4xl font-black tracking-tighter uppercase mb-4">Aucun Espace.</h3>
                    <p class="text-gray-400 mb-8 max-w-sm mx-auto">Créez votre première colocation pour commencer à gérer vos finances.</p>
                    <a href="{{ route('colocations.create') }}" class="bg-black text-white px-8 py-4 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-all">
                        + Créer ma première colocation
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout> 