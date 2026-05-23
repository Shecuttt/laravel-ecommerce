@extends('layouts.storefront')

@section('title', 'Checkout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-8">Checkout</h1>

    <div class="lg:grid lg:grid-cols-12 lg:gap-x-12">
        <!-- Billing / Shipping Form -->
        <div class="lg:col-span-7">
            <div class="bg-white dark:bg-gray-800 border border-gray-150 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 border-b border-gray-100 dark:border-gray-700 pb-4">Shipping Information</h2>
                
                <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Full Name</label>
                        <input type="text" id="name" value="{{ Auth::user()->name }}" disabled
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-gray-500 bg-gray-50 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Email Address</label>
                        <input type="email" id="email" value="{{ Auth::user()->email }}" disabled
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-gray-500 bg-gray-50 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="shipping_address" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Shipping Address</label>
                        <textarea name="shipping_address" id="shipping_address" rows="4" required
                            placeholder="Enter your complete delivery address here..."
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-950 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('shipping_address') border-red-500 @enderror">{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-950 p-4 rounded-lg border border-gray-100 dark:border-gray-800">
                        <div class="flex items-center">
                            <input id="dummy_payment" type="radio" checked disabled
                                class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <label for="dummy_payment" class="ml-3 block text-sm font-bold text-gray-900 dark:text-white">
                                Cash on Delivery (COD) / Demo Flow
                            </label>
                        </div>
                        <p class="mt-1 ml-7 text-xs text-gray-500">Your order will be processed with a pending payment status. No actual credit card details are required.</p>
                    </div>

                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-semibold rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-600/20">
                        Place Order (${{ number_format($total, 2) }})
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="mt-10 lg:mt-0 lg:col-span-5">
            <div class="bg-white dark:bg-gray-800 border border-gray-150 dark:border-gray-700 rounded-xl p-6 shadow-sm sticky top-24">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-4 mb-4">Items in Order</h2>
                
                <div class="flow-root">
                    <ul class="-my-4 divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($cart as $item)
                            <li class="py-4 flex">
                                <div class="flex-shrink-0 w-16 h-16 bg-gray-100 dark:bg-gray-900 rounded-md overflow-hidden flex items-center justify-center">
                                    @if($item['image_url'])
                                        <img src="{{ asset('storage/' . $item['image_url']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    @endif
                                </div>
                                <div class="ml-4 flex-1 flex flex-col justify-between">
                                    <div class="flex items-start justify-between">
                                        <h4 class="text-sm font-semibold text-gray-950 dark:text-white">{{ $item['name'] }}</h4>
                                        <p class="ml-4 text-sm font-bold text-gray-950 dark:text-white">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                    </div>
                                    <div class="flex-1 flex items-end justify-between text-xs text-gray-500">
                                        <p>Qty {{ $item['quantity'] }} @ ${{ number_format($item['price'], 2) }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-6 border-t border-gray-100 dark:border-gray-700 pt-6 space-y-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                        <span class="font-semibold">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                        <span class="text-green-600 font-semibold">Free</span>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-700 pt-4 flex items-center justify-between text-base font-extrabold text-gray-900 dark:text-white">
                        <span>Total</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
