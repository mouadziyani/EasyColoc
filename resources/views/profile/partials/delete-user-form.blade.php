<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-gray-950 tracking-tight">
            {{ __('Supprimer le compte') }}
        </h2>

        <p class="mt-2 text-sm text-gray-600 max-w-lg">
            {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Avant de supprimer votre compte, veuillez télécharger les données ou informations que vous souhaitez conserver.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="rounded-xl px-6 py-2.5 bg-red-600 hover:bg-red-700"
    >
        {{ __('Supprimer le compte') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-extrabold text-gray-950 tracking-tight">
                {{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}
            </h2>

            <p class="mt-3 text-sm text-gray-600">
                {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.') }}
            </p>

            <div class="mt-8">
                <x-input-label for="password" value="{{ __('Mot de passe') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full rounded-xl border-gray-200 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50"
                    placeholder="{{ __('Mot de passe') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-10 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="rounded-xl px-6 py-2.5">
                    {{ __('Annuler') }}
                </x-secondary-button>

                <x-danger-button class="rounded-xl px-6 py-2.5 bg-red-600 hover:bg-red-700">
                    {{ __('Supprimer le compte') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>