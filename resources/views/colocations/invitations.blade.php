<x-app-layout>
    <div class="min-h-screen bg-white text-[#1a1a1a] selection:bg-black selection:text-white">
        
        <div class="max-w-7xl mx-auto px-6 pt-16 pb-12 border-b border-gray-100">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-gray-400 mb-2 font-semibold italic">03 — Gestion / Invitation</p>
                    <h1 class="text-6xl font-black tracking-tighter text-gray-900 uppercase leading-none">
                        Inviter<span class="text-indigo-600">.</span>
                    </h1>
                </div>
                
                <a href="{{ route('colocations.show', $colocation) }}" class="text-sm font-medium hover:line-through transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Retour à la coloc
                </a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 lg:grid-cols-12 gap-16">
            
            <div class="lg:col-span-4 border-t-2 border-black pt-8">
                <p class="text-lg leading-relaxed font-medium">
                    Invitez un nouveau membre à rejoindre <span class="font-black italic">{{ $colocation->name }}</span>.
                </p>
                <p class="text-sm text-gray-500 mt-4">Un email sera envoyé automatiquement avec les instructions de connexion.</p>
                <div class="mt-12 space-y-4 text-sm text-gray-500">
                    <p>● Email valide requis</p>
                    <p>● Invitation sécurisée</p>
                    <p>● Accès immédiat</p>
                </div>
            </div>

            <div class="lg:col-span-8">
                <form action="{{ route('colocations.invite', $colocation) }}" method="POST" class="space-y-12">
                    @csrf

                    <div class="relative group">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400 group-focus-within:text-black transition-colors">Adresse Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" 
                               placeholder="Ex: ami@coloc.ma"
                               class="w-full border-0 border-b border-gray-200 py-6 px-0 text-3xl font-light focus:ring-0 focus:border-black transition-all placeholder:text-gray-100 uppercase tracking-tighter"
                               required>
                        @error('email') <span class="text-xs text-red-600 mt-2 block font-mono italic">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-10">
                        <button type="submit" class="relative overflow-hidden bg-black text-white px-12 py-5 rounded-full group transition-all duration-500 hover:pr-16">
                            <span class="relative z-10 font-bold uppercase text-sm tracking-widest">Envoyer l'invitation</span>
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