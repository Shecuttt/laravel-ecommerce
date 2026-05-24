<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-background">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Toko') | {{ config('app.name', 'ambilidis') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-foreground bg-background flex flex-col min-h-screen">
        <!-- Navigation -->
        <nav x-data="{ open: false }" class="bg-card/95 backdrop-blur-md border-b border-border/80 sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="flex items-center space-x-2">
                            <!-- Logo Placeholder -->
                            <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-primary-foreground font-extrabold text-sm shadow-sm border border-primary/10">
                                A
                            </div>
                            <span class="text-xl font-bold tracking-tight text-foreground">ambilidis</span>
                        </a>

                        <div class="hidden sm:flex sm:space-x-6">
                            <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-primary text-foreground' : 'border-transparent text-muted-foreground hover:text-foreground' }} text-sm font-medium transition-colors">Beranda</a>
                            <a href="{{ route('products') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('products') ? 'border-primary text-foreground' : 'border-transparent text-muted-foreground hover:text-foreground' }} text-sm font-medium transition-colors">Produk</a>
                        </div>
                    </div>

                    <!-- Search, Cart & User -->
                    <div class="flex items-center space-x-4">
                        <!-- Search Form (Simple desktop view) -->
                        <form action="{{ route('products') }}" method="GET" class="hidden md:block relative">
                            <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}"
                                class="w-60 bg-muted border-none rounded-full py-1.5 pl-4 pr-10 text-sm focus:ring-2 focus:ring-primary placeholder-muted-foreground text-foreground">
                            <button type="submit" class="absolute right-3 top-2.5 text-muted-foreground hover:text-foreground transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        </form>

                        <!-- Cart Icon -->
                        <a href="{{ route('cart') }}" class="relative p-2 text-muted-foreground hover:text-primary transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            @php $cartCount = collect(session('cart', []))->sum('quantity'); @endphp
                            @if($cartCount > 0)
                                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-semibold leading-none text-primary-foreground bg-primary rounded-full transform translate-x-1/2 -translate-y-1/2">{{ $cartCount }}</span>
                            @endif
                        </a>

                        <!-- Auth Controls (Desktop) -->
                        <div class="hidden sm:flex sm:items-center sm:space-x-4">
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-muted-foreground hover:text-primary transition-colors">Akun Saya</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-sm font-semibold text-destructive hover:text-destructive/80 transition-colors">Keluar</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-muted-foreground hover:text-primary transition-colors">Masuk</a>
                                <a href="{{ route('register') }}" class="bg-primary hover:bg-primary/90 text-primary-foreground px-4 py-2 rounded-md text-sm font-semibold transition-all shadow-sm">Daftar</a>
                            @endauth
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-muted-foreground hover:text-foreground hover:bg-muted focus:outline-none focus:bg-muted transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="sm:hidden bg-card border-t border-border shadow-lg"
                 style="display: none;">
                
                <!-- Mobile Search -->
                <div class="px-4 pt-4 pb-2 md:hidden">
                    <form action="{{ route('products') }}" method="GET" class="relative">
                        <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}"
                            class="w-full bg-muted border-none rounded-full py-2 pl-4 pr-10 text-sm focus:ring-2 focus:ring-primary placeholder-muted-foreground text-foreground">
                        <button type="submit" class="absolute right-3 top-2.5 text-muted-foreground hover:text-foreground transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>
                </div>

                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('home') ? 'border-primary text-primary bg-primary/5 font-bold' : 'border-transparent text-muted-foreground hover:text-foreground hover:bg-muted font-medium' }} text-base transition-colors">Beranda</a>
                    <a href="{{ route('products') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('products') ? 'border-primary text-primary bg-primary/5 font-bold' : 'border-transparent text-muted-foreground hover:text-foreground hover:bg-muted font-medium' }} text-base transition-colors">Produk</a>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-4 border-t border-border">
                    @auth
                        <div class="px-4">
                            <div class="font-bold text-base text-foreground">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-muted-foreground">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-base font-semibold text-muted-foreground hover:text-primary transition-colors">Akun Saya</a>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-base font-semibold text-destructive hover:bg-destructive/10 transition-colors">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="px-4 space-y-2">
                            <a href="{{ route('login') }}" class="block w-full text-center py-2.5 text-base font-semibold text-muted-foreground hover:text-primary transition-colors">Masuk</a>
                            <a href="{{ route('register') }}" class="block w-full text-center py-2.5 text-base font-semibold text-primary-foreground bg-primary hover:bg-primary/90 rounded-md transition-colors">Daftar</a>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-md dark:bg-green-950/20 dark:border-green-600">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-800 dark:text-green-300 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-destructive/10 border-l-4 border-destructive p-4 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-destructive" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-destructive font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-card border-t border-border mt-auto">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:justify-between items-center space-y-4 md:space-y-0">
                    <div class="text-muted-foreground text-sm">
                        &copy; {{ date('Y') }} {{ config('app.name', 'ambilidis') }}. Hak Cipta Dilindungi.
                    </div>
                    <div class="flex space-x-6 text-sm text-muted-foreground">
                        <a href="{{ route('products') }}" class="hover:text-foreground transition-colors">Produk</a>
                        <a href="#" class="hover:text-foreground transition-colors">Kebijakan Privasi</a>
                        <a href="#" class="hover:text-foreground transition-colors">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
