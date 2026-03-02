<x-guest-layout>
    <div class="bg-white border border-gray-100 rounded-[2rem] p-6 shadow-sm">
        
        <h2 class="text-2xl font-black text-gray-900 tracking-tighter mb-6">Inscription</h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Name')" class="text-xs text-gray-400 uppercase tracking-widest font-bold" />
                <x-text-input id="name" class="block mt-2 w-full border-gray-200 rounded-xl focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                              type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" class="text-xs text-gray-400 uppercase tracking-widest font-bold" />
                <x-text-input id="email" class="block mt-2 w-full border-gray-200 rounded-xl focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                              type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-xs text-gray-400 uppercase tracking-widest font-bold" />
                <x-text-input id="password" class="block mt-2 w-full border-gray-200 rounded-xl focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-xs text-gray-400 uppercase tracking-widest font-bold" />
                <x-text-input id="password_confirmation" class="block mt-2 w-full border-gray-200 rounded-xl focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="text-sm text-gray-500 hover:text-gray-900 transition-colors" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="bg-gray-900 hover:bg-gray-700 rounded-full px-5 py-2.5 ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>