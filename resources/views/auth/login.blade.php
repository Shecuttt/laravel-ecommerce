<x-guest-layout>
    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-foreground tracking-tight">Masuk ke Akun Anda</h2>
        <p class="mt-2 text-sm text-muted-foreground">
            Atau
            <a href="{{ route('register') }}" class="font-semibold text-primary hover:text-primary/80 transition-colors">
                buat akun pelanggan baru
            </a>
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="font-semibold text-foreground" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Kata Sandi')" class="font-semibold text-foreground" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-primary hover:text-primary/80 transition-colors" href="{{ route('password.request') }}">
                        {{ __('Lupa kata sandi Anda?') }}
                    </a>
                @endif
            </div>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-border bg-background text-primary shadow-sm focus:ring-primary" name="remember">
                <span class="ms-2 text-sm text-muted-foreground">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        <div>
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-primary hover:bg-primary/90 text-primary-foreground border border-transparent rounded-md font-semibold text-sm shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                {{ __('Masuk') }}
            </button>
        </div>
    </form>

    <!-- Divider -->
    <div class="relative flex py-5 items-center">
        <div class="flex-grow border-t border-border"></div>
        <span class="flex-shrink mx-4 text-muted-foreground text-sm">atau</span>
        <div class="flex-grow border-t border-border"></div>
    </div>

    <!-- Google Login Button -->
    <div class="flex items-center justify-center">
        <a href="{{ route('auth.google.redirect') }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-border rounded-md shadow-sm text-sm font-semibold text-foreground bg-card hover:bg-muted focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all">
            <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            {{ __('Masuk dengan Google') }}
        </a>
    </div>
</x-guest-layout>
