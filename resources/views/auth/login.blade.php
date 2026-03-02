<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="bg-white border border-gray-100 rounded-[2rem] p-6 shadow-sm">
        
        <h2 class="text-2xl font-black text-gray-900 tracking-tighter mb-6">Connexion</h2>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" class="text-xs text-gray-400 uppercase tracking-widest font-bold" />
                <x-text-input id="email" class="block mt-2 w-full border-gray-200 rounded-xl focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                              type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-xs text-gray-400 uppercase tracking-widest font-bold" />

                <x-text-input id="password" class="block mt-2 w-full border-gray-200 rounded-xl focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              type="password"
                              name="password"
                              required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            
            <div class="flex flex-col sm:flex-row items-center justify-between mt-6 space-y-4 sm:space-y-0">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" 
                        class="text-sm text-indigo-600 hover:text-indigo-900 font-semibold transition-colors"> 
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                
                <div class="flex items-center gap-4">
                    <a href="{{ route('register') }}" 
                        class="text-sm text-gray-500 hover:text-gray-900 transition-colors">
                        {{ __('Register') }}
                    </a>
                    
                    <x-primary-button class="bg-gray-900 hover:bg-gray-700 rounded-full px-5 py-2.5">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>