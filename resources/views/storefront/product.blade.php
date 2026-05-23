@extends('layouts.storefront')

@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumbs -->
    <nav class="flex mb-8 text-sm font-medium text-gray-500 dark:text-gray-400">
        <a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a>
        <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('products') }}" class="hover:text-indigo-600">Products</a>
        <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('products', ['category' => $product->category->slug]) }}" class="hover:text-indigo-600">{{ $product->category->name }}</a>
    </nav>

    <!-- Product Layout -->
    <div class="lg:grid lg:grid-cols-2 lg:gap-x-12">
        <!-- Image Area -->
        <div class="flex justify-center bg-gray-50 dark:bg-gray-800 rounded-2xl p-8 border border-gray-100 dark:border-gray-700 min-h-[400px]">
            @if($product->image_url)
                <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="max-h-[500px] w-auto object-contain rounded-lg">
            @else
                <div class="flex flex-col items-center justify-center text-gray-400">
                    <svg class="w-24 h-24 stroke-current" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="mt-4 text-sm font-semibold">No image preview available</span>
                </div>
            @endif
        </div>

        <!-- Info Area -->
        <div class="mt-10 lg:mt-0 lg:pl-8 flex flex-col justify-between">
            <div>
                <span class="text-sm font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">
                    {{ $product->category->name }}
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white mt-2">
                    {{ $product->name }}
                </h1>
                
                <div class="mt-6 flex items-center justify-between border-b border-gray-100 dark:border-gray-700 pb-6">
                    <span class="text-3xl font-extrabold text-gray-900 dark:text-white">
                        ${{ number_format($product->price, 2) }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $product->stock > 0 ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' }}">
                        {{ $product->stock > 0 ? 'In Stock (' . $product->stock . ')' : 'Out of Stock' }}
                    </span>
                </div>

                <div class="mt-6">
                    <h3 class="text-sm font-medium text-gray-900 dark:text-white uppercase tracking-wider">Description</h3>
                    <div class="mt-4 text-gray-600 dark:text-gray-400 space-y-4 leading-relaxed">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
            </div>

            <!-- Action Area -->
            <div class="mt-10 pt-8 border-t border-gray-100 dark:border-gray-700">
                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
                        @csrf
                        <div class="w-32">
                            <label for="quantity" class="sr-only">Quantity</label>
                            <div class="relative rounded-md shadow-sm">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 text-sm">Qty</span>
                                <input type="number" name="quantity" id="quantity" min="1" max="{{ $product->stock }}" value="1"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-12 pr-3 py-2.5 sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-md">
                            </div>
                        </div>
                        <button type="submit" class="flex-grow inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-semibold rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-600/20">
                            Add to Cart
                        </button>
                    </form>
                @else
                    <button disabled class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-semibold rounded-md text-gray-500 bg-gray-200 dark:bg-gray-800 cursor-not-allowed">
                        Sold Out
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mt-24 border-t border-gray-200 dark:border-gray-800 pt-16">
            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight">You might also like</h2>
            <div class="mt-8 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach($relatedProducts as $related)
                    <div class="group relative flex flex-col bg-white dark:bg-gray-800 border border-gray-150 dark:border-gray-700 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200 group-hover:opacity-90 transition-opacity min-h-60 flex items-center justify-center">
                            @if($related->image_url)
                                <img src="{{ asset('storage/' . $related->image_url) }}" alt="{{ $related->name }}" class="h-full w-full object-cover object-center">
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
                                    {{ $related->category->name }}
                                </span>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mt-1">
                                    <a href="{{ route('product.show', $related->slug) }}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $related->name }}
                                    </a>
                                </h3>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-xl font-extrabold text-gray-900 dark:text-white">
                                    ${{ number_format($related->price, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
