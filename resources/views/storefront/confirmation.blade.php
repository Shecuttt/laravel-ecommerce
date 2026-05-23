@extends('layouts.storefront')

@section('title', 'Order Confirmation')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
    <!-- Success Icon -->
    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full text-green-600 dark:bg-green-900/30 dark:text-green-400 mb-6">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 9L20 4"></path></svg>
    </div>

    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-2">Order Confirmed!</h1>
    <p class="text-gray-500 dark:text-gray-400 mb-8">Thank you for your purchase. Your order has been received and is being processed.</p>

    <!-- Order Info Card -->
    <div class="bg-white dark:bg-gray-800 border border-gray-150 dark:border-gray-700 rounded-xl p-6 shadow-sm text-left mb-8">
        <div class="flex justify-between items-center border-b border-gray-100 dark:border-gray-700 pb-4 mb-4">
            <span class="font-bold text-gray-900 dark:text-white">Order #{{ $order->id }}</span>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold uppercase bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
                {{ $order->status }}
            </span>
        </div>

        <div class="space-y-4">
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400">Shipping Address</h4>
                <p class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $order->shipping_address }}</p>
            </div>
            
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400">Items Ordered</h4>
                <ul class="mt-2 divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($order->items as $item)
                        <li class="py-2.5 flex justify-between text-sm">
                            <span class="text-gray-700 dark:text-gray-300">
                                {{ $item->product->name }} <span class="text-gray-400">x{{ $item->quantity }}</span>
                            </span>
                            <span class="font-semibold text-gray-950 dark:text-white">
                                ${{ number_format($item->unit_price * $item->quantity, 2) }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="border-t border-gray-100 dark:border-gray-700 pt-4 flex justify-between items-center font-extrabold text-base text-gray-900 dark:text-white">
                <span>Total Amount Paid (COD)</span>
                <span>${{ number_format($order->total_amount, 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex justify-center space-x-4">
        <a href="{{ route('products') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-semibold rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
            Continue Shopping
        </a>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-sm font-semibold rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
            View My Orders
        </a>
    </div>
</div>
@endsection
