<x-app-layout>
    <div class="min-h-screen bg-white text-[#1a1a1a] selection:bg-black selection:text-white">
        
        <div class="max-w-7xl mx-auto px-6 pt-16 pb-12 border-b border-gray-100">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-gray-400 mb-2 font-semibold italic">04 — Dépenses / Détails</p>
                    <h1 class="text-5xl font-black tracking-tighter text-gray-900 uppercase leading-none max-w-2xl">
                        {{ $expense->title }}<span class="text-indigo-600">.</span>
                    </h1>
                </div>
                
                <a href="{{ route('colocations.expenses.index', $colocation) }}" class="text-sm font-medium hover:line-through transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Retour aux dépenses
                </a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                
                <div class="md:col-span-2 border-r border-gray-100 pr-12">
                    <p class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2">Montant de la dépense</p>
                    <p class="text-8xl font-black tracking-tighter text-gray-900">
                        {{ number_format($expense->amount, 2) }} <span class="text-3xl font-light text-gray-400">MAD</span>
                    </p>
                    
                    <div class="mt-12 flex flex-wrap gap-3">
                        @if($expense->category)
                            <span class="bg-gray-100 text-gray-800 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full">
                                {{ $expense->category->name }}
                            </span>
                        @endif
                        <span class="bg-indigo-50 text-indigo-700 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full">
                            Payé par: {{ $expense->payer->name }}
                        </span>
                    </div>
                </div>

                <div class="space-y-8">
                    <div>
                        <p class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-1">Date de l'opération</p>
                        <p class="text-2xl font-bold tracking-tight">{{ $expense->date->format('d F Y') }}</p>
                    </div>
                    
                    <div>
                        <p class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-1">Colocation liée</p>
                        <p class="text-2xl font-bold tracking-tight">{{ $colocation->name }}</p>
                        <p class="text-sm text-gray-500">{{ $colocation->address }}</p>
                    </div>

                    <div class="pt-8 border-t border-gray-100">
                        <a href="{{ route('colocations.expenses.edit', [$colocation, $expense]) }}" 
                           class="inline-flex items-center gap-2 text-sm font-black uppercase tracking-widest text-indigo-600 hover:text-black transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Modifier cette dépense
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>