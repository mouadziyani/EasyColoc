<x-app-layout>
    <div class="min-h-screen bg-[#F9FAFB] text-[#1a1a1a] selection:bg-black selection:text-white">
        <div class="max-w-7xl mx-auto px-6 pt-10">
            
            <nav class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">
                <a href="{{ route('colocations.index') }}" class="hover:text-black transition-colors">Colocations</a>
                <span>/</span>
                <span class="text-black">{{ $colocation->name }}</span>
            </nav>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-2xl text-sm font-bold border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-10 border-b border-gray-100">
                <h1 class="text-6xl font-black tracking-tighter text-gray-900 uppercase italic leading-none">
                    {{ $colocation->name }}<span class="text-indigo-600">.</span>
                </h1>
                
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('colocations.expenses.create', $colocation) }}" 
                       class="bg-black text-white px-8 py-4 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-all shadow-2xl shadow-gray-200">
                        + Dépense
                    </a>
                    
                    <button onclick="openModal()" class="bg-white border border-gray-200 text-gray-900 px-8 py-4 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-gray-50 transition-all">
                        Inviter
                    </button>
                    
                    @if($colocation->owner_id === auth()->id())
                        <a href="{{ route('colocations.edit', $colocation) }}" class="p-4 bg-gray-100 rounded-full hover:bg-gray-200 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <div class="lg:col-span-4 space-y-8">
                    <div class="bg-white border border-gray-100 rounded-[2rem] p-8 shadow-sm">
                        <h3 class="text-xs uppercase tracking-[0.2em] font-black text-gray-400 mb-6">Le Lieu</h3>
                        <p class="text-gray-600 leading-relaxed mb-6 font-light">{{ $colocation->description ?? 'Aucune description fournie.' }}</p>
                        
                        <div class="space-y-4 pt-6 border-t border-gray-100">
                            <div class="flex items-start gap-3">
                                <span class="text-gray-900 font-bold text-sm w-20">Lieu:</span>
                                <span class="text-sm text-gray-500">{{ $colocation->address }}</span>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-gray-900 font-bold text-sm w-20">Admin:</span>
                                <span class="text-sm text-gray-500">{{ $colocation->owner->name }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-100 rounded-[2rem] p-8 shadow-sm">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xs uppercase tracking-[0.2em] font-black text-gray-400">Membres & Soldes</h3>
                            <span class="bg-gray-100 text-gray-500 text-[10px] font-bold px-3 py-1 rounded-full">{{ $colocation->members->count() }}</span>
                        </div>
                        
                        <div class="bg-gray-50 rounded-2xl p-6 text-center mb-6">
                            <p class="text-xs text-gray-500 uppercase tracking-widest font-bold">Total Dépenses</p>
                            <p class="text-4xl font-black text-gray-900 tracking-tighter">
                                {{ number_format($totalExpenses ?? 0, 2) }} <span class="text-xl font-light text-gray-400">MAD</span>
                            </p>
                        </div>

                        <div class="space-y-4">
                            @foreach($memberBalances as $balance)
                                <div class="flex justify-between items-center pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                                    <div>
                                        <p class="font-bold text-sm text-gray-900">{{ $balance['name'] }}</p>
                                        <p class="text-xs text-gray-400">a payé: {{ number_format($balance['paid'], 2) }} MAD</p>
                                    </div>
                                    
                                    @if($balance['balance'] > 0)
                                        <span class="text-green-600 font-bold text-xs bg-green-50 px-3 py-1 rounded-full">
                                            +{{ number_format($balance['balance'], 2) }} MAD
                                        </span>
                                    @elseif($balance['balance'] < 0)
                                        <span class="text-red-600 font-bold text-xs bg-red-50 px-3 py-1 rounded-full">
                                            {{ number_format($balance['balance'], 2) }} MAD
                                        </span>
                                    @else
                                        <span class="text-gray-400 font-bold text-xs bg-gray-50 px-3 py-1 rounded-full">
                                            À jour
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-8">
                    <div class="bg-white border border-gray-100 rounded-[2rem] overflow-hidden shadow-sm">
                        <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center">
                            <h3 class="text-xs uppercase tracking-[0.2em] font-black text-gray-400">Dépenses Récentes</h3>
                            <a href="{{ route('categories.create') }}" class="text-[10px] font-bold text-gray-400 hover:text-black uppercase underline tracking-tighter">Gérer Catégories</a>
                        </div>

                        <div class="divide-y divide-gray-50">
                            @forelse($colocation->expenses->sortByDesc('date') as $expense)
                                <div class="px-8 py-6 flex items-center justify-between hover:bg-gray-50/50 transition-colors group">
                                    <div class="flex items-center gap-5">
                                        <div class="w-14 h-14 bg-gray-100 rounded-3xl flex items-center justify-center text-3xl">
                                            {{ $expense->category->icon ?? '$$' }}
                                        </div>
                                        <div>
                                            <h4 class="font-black text-gray-900 text-lg uppercase tracking-tight">{{ $expense->title }}</h4>
                                            <p class="text-xs text-gray-400 uppercase font-bold tracking-widest mt-1">
                                                {{ $expense->category->name ?? 'Général' }} • {{ $expense->date->format('d M') }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-6">
                                        <span class="text-2xl font-black tracking-tighter">{{ number_format($expense->amount, 2) }} <small class="text-sm font-light text-gray-400">MAD</small></span>
                                        
                                        @if(auth()->id() === $expense->user_id || auth()->id() === $colocation->owner_id)
                                            <div class="opacity-0 group-hover:opacity-100 transition-opacity flex gap-2">
                                                <form action="{{ route('colocations.expenses.destroy', [$colocation, $expense]) }}" method="POST" onsubmit="return confirm('Sûr ?')">
                                                    @csrf @method('DELETE')
                                                    <button class="p-2 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-full transition-all">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="p-20 text-center">
                                    <p class="text-gray-300 font-medium italic text-lg">Aucune transaction pour le moment.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="inviteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 {{ $errors->has('email') ? '' : 'hidden' }} flex items-center justify-center p-4">
        <div class="bg-white rounded-[3rem] p-10 w-full max-w-xl shadow-2xl transform transition-all">
            
            <div class="flex justify-between items-center mb-10">
                <h3 class="text-4xl font-black tracking-tighter uppercase">Inviter<span class="text-indigo-600">.</span></h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-black">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="{{ route('colocations.invite', $colocation) }}" method="POST" class="space-y-8">
                @csrf
                
                <div class="relative group">
                    <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400 group-focus-within:text-black transition-colors">Adresse Email</label>
                    <input type="email" name="email" 
                           placeholder="Ex: ami@coloc.ma"
                           class="w-full border-0 border-b border-gray-200 py-6 px-0 text-3xl font-light focus:ring-0 focus:border-black transition-all placeholder:text-gray-100 uppercase tracking-tighter"
                           required>
                    @error('email') <span class="text-xs text-red-600 mt-2 block font-mono italic">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full bg-black text-white px-8 py-5 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-all">
                    Envoyer l'invitation
                </button>
            </form>
        </div>
    </div>
    

    <script>
        const modal = document.getElementById('inviteModal');
        
        function openModal() {
            modal.classList.remove('hidden');
        }
        
        function closeModal() {
            modal.classList.add('hidden');
        }
        
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</x-app-layout>