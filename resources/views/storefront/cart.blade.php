@extends('layouts.storefront')

@section('title', 'Shopping Cart')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-8">Shopping Cart</h1>

    @if(empty($cart))
        <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl border border-gray-150 dark:border-gray-700 p-8 shadow-sm">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            <h2 class="mt-4 text-xl font-bold text-gray-900 dark:text-white">Your cart is empty</h2>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Add products to your cart to see them here.</p>
            <div class="mt-6">
                <a href="{{ route('products') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-semibold rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                    Continue Shopping
                </a>
            </div>
        </div>
    @else
        <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
            <!-- Cart Items -->
            <div class="lg:col-span-8 space-y-4">
                @foreach($cart as $item)
                    <div class="flex items-center bg-white dark:bg-gray-800 border border-gray-150 dark:border-gray-700 p-4 rounded-xl shadow-sm">
                        <div class="w-20 h-20 bg-gray-100 dark:bg-gray-900 rounded-lg flex-shrink-0 flex items-center justify-center overflow-hidden">
                            @if($item['image_url'])
                                <img src="{{ asset('storage/' . $item['image_url']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            @endif
                        </div>
                        <div class="ml-4 flex-grow flex flex-col sm:flex-row sm:justify-between">
                            <div>
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">{{ $item['name'] }}</h3>
                                <p class="mt-1 text-sm text-gray-500">${{ number_format($item['price'], 2) }} each</p>
                            </div>
                            <div class="mt-4 sm:mt-0 flex items-center justify-between sm:space-x-6">
                                <div class="flex items-center space-x-1">
                                    <span class="text-sm text-gray-600 dark:text-gray-400 font-medium mr-2">Qty: {{ $item['quantity'] }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-base font-extrabold text-gray-900 dark:text-white">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                </div>
                                <form action="{{ route('cart.remove') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-1 rounded-md hover:bg-red-50 dark:hover:bg-red-950/20 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="mt-10 lg:mt-0 lg:col-span-4 bg-white dark:bg-gray-800 border border-gray-150 dark:border-gray-700 rounded-xl p-6 shadow-sm sticky top-24">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-4">Order Summary</h2>
                <div class="mt-4 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                        <span class="font-bold">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                        <span class="text-green-600 font-semibold">Free</span>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-700 pt-4 flex items-center justify-between text-base font-extrabold text-gray-900 dark:text-white">
                        <span>Total</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                </div>
                <div class="mt-6">
                    <a href="{{ route('checkout') }}" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-semibold rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-600/20">
                        Proceed to Checkout
                    </a>
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('products') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 inline-flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        <span>Continue Shopping</span>
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
