<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-background">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ambilidis') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-foreground h-full bg-background">
        <div class="min-h-screen flex">
            <!-- Left Side: Visual/Branding (hidden on mobile) -->
            <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden items-center justify-center bg-primary">
                <!-- Decorative background gradients -->
                <div class="absolute inset-0 bg-gradient-to-tr from-primary via-primary/95 to-primary/80 opacity-95 z-0"></div>
                <div class="absolute -top-40 -left-40 w-96 h-96 bg-accent rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
                <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-accent rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>

                <div class="relative z-10 max-w-md text-center px-8">
                    <a href="/" class="inline-flex items-center space-x-2 text-3xl font-extrabold tracking-tight text-white mb-6">
                        <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-primary font-extrabold text-lg shadow-md">
                            A
                        </div>
                        <span class="text-2xl font-bold tracking-tight text-white">ambilidis</span>
                    </a>
                    <h2 class="text-3xl font-extrabold text-white tracking-tight sm:text-4xl">
                        Gaya Hidup Terbaik.
                    </h2>
                    <p class="mt-4 text-lg text-primary-foreground/85">
                        Bergabunglah dengan komunitas pembeli pilihan kami dan dapatkan akses ke produk eksklusif, penawaran khusus, dan pengiriman prioritas.
                    </p>
                    <div class="mt-8 flex justify-center space-x-6 text-primary-foreground/60 text-sm font-semibold">
                        <a href="{{ route('products') }}" class="hover:text-white transition-colors">Lihat Produk</a>
                        <span>&bull;</span>
                        <a href="#" class="hover:text-white transition-colors">Pembayaran Aman</a>
                        <span>&bull;</span>
                        <a href="#" class="hover:text-white transition-colors">Layanan 24/7</a>
                    </div>
                </div>
            </div>

            <!-- Right Side: Auth Form -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center py-12 px-6 sm:px-12 lg:px-20 bg-card shadow-xl border-l border-border">
                <div class="mx-auto w-full max-w-sm">
                    <!-- Mobile Logo -->
                    <div class="flex lg:hidden justify-center mb-6">
                        <a href="/" class="inline-flex items-center space-x-2">
                            <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-primary-foreground font-extrabold text-sm shadow-sm">
                                A
                            </div>
                            <span class="text-xl font-bold tracking-tight text-foreground">ambilidis</span>
                        </a>
                    </div>

                    <!-- Inner Card / Container -->
                    <div class="bg-card">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
