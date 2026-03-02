<x-app-layout>
    <div class="min-h-screen bg-white text-[#1a1a1a] selection:bg-black selection:text-white">
        
        <div class="max-w-7xl mx-auto px-6 pt-16 pb-12 border-b border-gray-100">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-gray-400 mb-2 font-semibold italic">04 — Dépenses</p>
                    <h1 class="text-6xl font-black tracking-tighter text-gray-900 uppercase leading-none">
                        {{ $colocation->name }}<span class="text-indigo-600">.</span>
                    </h1>
                </div>
                
                <a href="{{ route('colocations.expenses.create', $colocation) }}" 
                   class="bg-black text-white px-8 py-4 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-all shadow-2xl shadow-gray-200">
                    + Nouvelle Dépense
                </a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-12">
            
            @if($expenses->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($expenses as $expense)
                        <div class="group border border-gray-100 rounded-[2rem] p-8 hover:border-black transition-all duration-300 hover:shadow-2xl hover:shadow-gray-100 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start mb-6">
                                    <h3 class="text-2xl font-black uppercase tracking-tighter leading-none group-hover:text-indigo-600 transition-colors">
                                        {{ $expense->title }}
                                    </h3>
                                    <span class="text-xs font-bold text-gray-300 group-hover:text-black">
                                        {{ $loop->iteration < 10 ? '0'.$loop->iteration : $loop->iteration }}
                                    </span>
                                </div>
                                
                                <p class="text-4xl font-black tracking-tighter text-gray-900 mb-2">
                                    {{ number_format($expense->amount, 2) }} <span class="text-xl font-light text-gray-400">MAD</span>
                                </p>
                                
                                <div class="flex items-center gap-4 text-xs font-bold text-gray-400 uppercase tracking-widest mb-6 italic">
                                    <p>Par: {{ $expense->payer->name }}</p>
                                    <p class="text-gray-200">|</p>
                                    <p>{{ $expense->date->format('d/m/Y') }}</p>
                                </div>
                                
                                @if($expense->category)
                                    <span class="inline-block bg-gray-100 text-gray-600 text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">
                                        {{ $expense->category->name }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center justify-between pt-6 border-t border-gray-100 mt-auto">
                                <a href="{{ route('colocations.expenses.edit', [$colocation, $expense]) }}" class="text-xs font-black uppercase tracking-widest hover:text-indigo-600 transition-colors">
                                    Éditer
                                </a>
                                
                                <form action="{{ route('colocations.expenses.destroy', [$colocation, $expense]) }}" method="POST" onsubmit="return confirm('Confirmer la suppression?')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 border border-gray-100 rounded-full hover:bg-gray-50 text-gray-400 hover:text-red-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-32 border-2 border-dashed border-gray-100 rounded-[3rem]">
                    <h3 class="text-4xl font-black tracking-tighter uppercase mb-4">Aucune Dépense.</h3>
                    <p class="text-gray-400 mb-8 max-w-sm mx-auto">Ajoutez votre première dépense pour commencer à suivre vos finances.</p>
                    <a href="{{ route('colocations.expenses.create', $colocation) }}" class="bg-black text-white px-8 py-4 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-all">
                        + Ajouter une dépense
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>