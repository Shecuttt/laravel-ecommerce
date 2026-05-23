@extends('layouts.storefront')

@section('title', 'Welcome to Premium Store')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gray-900">
    <div class="absolute inset-0">
        <!-- Hero Banner Image (to be generated or fallback to overlay) -->
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-indigo-950 to-gray-900 opacity-90"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 flex flex-col items-center text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
            Elevate Your Everyday
        </h1>
        <p class="mt-6 max-w-2xl text-xl text-gray-300">
            Explore our curated collection of premium products designed to bring comfort, style, and functionality to your lifestyle.
        </p>
        <div class="mt-10 flex space-x-4">
            <a href="{{ route('products') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-600/30">
                Shop Collection
            </a>
            <a href="#categories" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-300 hover:text-white hover:border-white transition-colors">
                Browse Categories
            </a>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div id="categories" class="bg-white dark:bg-gray-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Shop by Category</h2>
        
        <div class="mt-8 grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-3 lg:grid-cols-4 xl:gap-x-8">
            @forelse($categories as $category)
                <a href="{{ route('products', ['category' => $category->slug]) }}" class="group relative flex flex-col overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 p-6 hover:shadow-md transition-shadow">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors">
                        {{ $category->name }}
                    </h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        {{ Str::limit($category->description, 60) }}
                    </p>
                    <span class="mt-4 text-xs font-semibold text-indigo-600 dark:text-indigo-400 inline-flex items-center space-x-1">
                        <span>View products</span>
                        <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </span>
                </a>
            @empty
                <div class="col-span-full py-8 text-center text-gray-500 dark:text-gray-400">
                    No categories found.
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Latest Products Section -->
<div class="bg-gray-50 dark:bg-gray-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Latest Arrivals</h2>
            <a href="{{ route('products') }}" class="text-indigo-600 dark:text-indigo-400 font-semibold hover:text-indigo-700 text-sm inline-flex items-center space-x-1">
                <span>View all</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @forelse($products as $product)
                <div class="group relative flex flex-col bg-white dark:bg-gray-800 border border-gray-150 dark:border-gray-700 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200 group-hover:opacity-90 transition-opacity min-h-60 flex items-center justify-center">
                        @if($product->image_url)
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center">
                        @else
                            <div class="flex flex-col items-center justify-center text-gray-400 p-8">
                                <svg class="w-12 h-12 stroke-current" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="mt-2 text-xs font-semibold">No image</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-semibold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">
                                {{ $product->category->name }}
                            </span>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mt-1">
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $product->name }}
                                </a>
                            </h3>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-xl font-extrabold text-gray-900 dark:text-white">
                                ${{ number_format($product->price, 2) }}
                            </span>
                            <span class="text-sm {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }} font-medium">
                                {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-500 dark:text-gray-400">
                    No products found. Add products in the Filament Admin panel to see them here!
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
