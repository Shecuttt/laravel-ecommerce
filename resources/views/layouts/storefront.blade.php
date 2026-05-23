<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50 dark:bg-gray-900">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Shop') | {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100 flex flex-col min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="flex items-center space-x-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <span class="bg-indigo-600 text-white px-2.5 py-1 rounded-md text-sm font-semibold">EC</span>
                            <span>{{ config('app.name', 'Laravel') }}</span>
                        </a>

                        <div class="hidden sm:flex sm:space-x-6">
                            <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-indigo-600 text-gray-900 dark:text-white' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }} text-sm font-medium">Home</a>
                            <a href="{{ route('products') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('products') ? 'border-indigo-600 text-gray-900 dark:text-white' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }} text-sm font-medium">Products</a>
                        </div>
                    </div>

                    <!-- Search, Cart & User -->
                    <div class="flex items-center space-x-4">
                        <!-- Search Form (Simple desktop view) -->
                        <form action="{{ route('products') }}" method="GET" class="hidden md:block relative">
                            <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}"
                                class="w-60 bg-gray-50 dark:bg-gray-800 border-none rounded-full py-1.5 pl-4 pr-10 text-sm focus:ring-2 focus:ring-indigo-600 dark:placeholder-gray-400">
                            <button type="submit" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        </form>

                        <!-- Cart Icon -->
                        <a href="{{ route('cart') }}" class="relative p-2 text-gray-600 dark:text-gray-300 hover:text-indigo-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            @php $cartCount = collect(session('cart', []))->sum('quantity'); @endphp
                            @if($cartCount > 0)
                                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-semibold leading-none text-white bg-indigo-600 rounded-full transform translate-x-1/2 -translate-y-1/2">{{ $cartCount }}</span>
                            @endif
                        </a>

                        <!-- Auth Controls -->
                        @auth
                            <div class="relative flex items-center space-x-3">
                                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600">Account</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 dark:text-red-400">Logout</button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600">Log in</a>
                            <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">Sign up</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-md dark:bg-green-950 dark:border-green-500">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 h-5 text-green-400 dark:text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700 dark:text-green-300">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-md dark:bg-red-950 dark:border-red-500">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 h-5 text-red-400 dark:text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700 dark:text-red-300">{{ session('error') }}</p>
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
        <footer class="bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800 mt-auto">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:justify-between items-center space-y-4 md:space-y-0">
                    <div class="text-gray-500 dark:text-gray-400 text-sm">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                    </div>
                    <div class="flex space-x-6 text-sm text-gray-500 dark:text-gray-400">
                        <a href="{{ route('products') }}" class="hover:text-gray-900 dark:hover:text-white">Shop</a>
                        <a href="#" class="hover:text-gray-900 dark:hover:text-white">Privacy Policy</a>
                        <a href="#" class="hover:text-gray-900 dark:hover:text-white">Terms of Service</a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
