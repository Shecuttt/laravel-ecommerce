<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-150 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold">Hello, {{ Auth::user()->name }}!</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">From your dashboard you can view your recent orders and manage your account profile details.</p>
                </div>
            </div>

            <!-- Orders History -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-150 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-6">Your Order History</h3>

                    @if($orders->isEmpty())
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">You haven't placed any orders yet.</p>
                            <div class="mt-4">
                                <a href="{{ route('products') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-semibold rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                                    Start Shopping
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($orders as $order)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 bg-gray-50 dark:bg-gray-900/50">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-gray-200 dark:border-gray-800 pb-4 mb-4 space-y-2 md:space-y-0">
                                        <div>
                                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Order ID</span>
                                            <p class="text-sm font-bold text-gray-900 dark:text-white mt-0.5">{{ $order->id }}</p>
                                        </div>
                                        <div>
                                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block md:text-right">Date Placed</span>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white mt-0.5">{{ $order->created_at->format('M d, Y') }}</p>
                                        </div>
                                        <div>
                                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block md:text-right">Order Status</span>
                                            <div class="mt-0.5">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold uppercase
                                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-950/30 dark:text-yellow-400
                                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800 dark:bg-blue-950/30 dark:text-blue-400
                                                    @elseif($order->status === 'shipped') bg-purple-100 text-purple-800 dark:bg-purple-950/30 dark:text-purple-400
                                                    @elseif($order->status === 'delivered') bg-green-100 text-green-800 dark:bg-green-950/30 dark:text-green-400
                                                    @else bg-red-100 text-red-800 dark:bg-red-950/30 dark:text-red-400 @endif">
                                                    {{ $order->status }}
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block md:text-right">Payment Status</span>
                                            <div class="mt-0.5">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold uppercase
                                                    @if($order->payment_status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-950/30 dark:text-yellow-400
                                                    @elseif($order->payment_status === 'paid') bg-green-100 text-green-800 dark:bg-green-950/30 dark:text-green-400
                                                    @else bg-red-100 text-red-800 dark:bg-red-950/30 dark:text-red-400 @endif">
                                                    {{ $order->payment_status }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                                        <!-- Items List -->
                                        <div class="md:col-span-2 space-y-2">
                                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Items</span>
                                            <ul class="divide-y divide-gray-100 dark:divide-gray-800">
                                                @foreach($order->items as $item)
                                                    <li class="py-2 flex items-center justify-between text-sm">
                                                        <span class="text-gray-700 dark:text-gray-300">
                                                            {{ $item->product->name }} <span class="text-gray-400 font-medium">x{{ $item->quantity }}</span>
                                                        </span>
                                                        <span class="font-semibold text-gray-900 dark:text-white">${{ number_format($item->unit_price * $item->quantity, 2) }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <!-- Total Info -->
                                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-150 dark:border-gray-700 flex flex-col justify-between items-center text-center">
                                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Paid</span>
                                            <span class="text-2xl font-extrabold text-gray-900 dark:text-white mt-1">${{ number_format($order->total_amount, 2) }}</span>
                                            <span class="text-xs text-gray-400 mt-1">Payment Method: COD</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
