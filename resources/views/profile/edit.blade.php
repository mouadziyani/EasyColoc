<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between pb-2 border-b border-gray-100">
            <h2 class="font-extrabold text-3xl text-gray-900 leading-tight tracking-tight">
                {{ __('Mon Compte') }}
            </h2>
            <div class="flex items-center gap-2 text-sm text-gray-500 bg-gray-100 px-4 py-2 rounded-full">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                <span>Sécurisé</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="md:col-span-2 p-8 bg-white shadow-lg shadow-gray-100 rounded-3xl border border-gray-100">
                    <div class="max-w-2xl">
                        <div class="mb-8 border-b border-gray-100 pb-6">
                            <h3 class="text-xl font-bold text-gray-950">Informations personnelles</h3>
                            <p class="mt-1 text-sm text-gray-600">Gérez vos informations personnelles, y compris votre nom et votre adresse e-mail.</p>
                        </div>
                        <div class="prose prose-sm max-w-none">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="p-8 bg-white shadow-lg shadow-gray-100 rounded-3xl border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-950">Sécurité</h3>
                        <p class="mt-1 text-sm text-gray-600">Mettez à jour votre mot de passe pour protéger votre compte.</p>
                        <div class="mt-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="p-8 bg-white shadow-lg shadow-gray-100 rounded-3xl border border-red-100 hover:border-red-200 transition-all duration-300">
                        <h3 class="text-xl font-bold text-red-600">Zone dangereuse</h3>
                        <p class="mt-1 text-sm text-red-500">La suppression est définitive. Soyez prudent.</p>
                        <div class="mt-6">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>