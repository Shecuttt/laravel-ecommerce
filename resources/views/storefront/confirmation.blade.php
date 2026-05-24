@extends('layouts.storefront')

@section('title', 'Konfirmasi Pesanan')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
    <!-- Success Icon -->
    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 dark:bg-green-950/30 rounded-full text-green-600 dark:text-green-400 mb-6">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 9L20 4"></path></svg>
    </div>

    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-foreground mb-2">Pesanan Dikonfirmasi!</h1>
    <p class="text-muted-foreground mb-8">Terima kasih atas pembelian Anda. Pesanan Anda telah kami terima dan sedang dalam proses.</p>

    <!-- Order Info Card -->
    <div class="bg-card border border-border rounded-xl p-6 shadow-sm text-left mb-8">
        <div class="flex justify-between items-center border-b border-border pb-4 mb-4">
            <span class="font-bold text-foreground">Pesanan #{{ $order->id }}</span>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold uppercase bg-accent/20 text-accent-foreground border border-accent/10">
                {{ $order->status }}
            </span>
        </div>

        <div class="space-y-4">
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Alamat Pengiriman</h4>
                <p class="mt-1 text-sm text-foreground">{{ $order->shipping_address }}</p>
            </div>
            
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Produk yang Dipesan</h4>
                <ul class="mt-2 divide-y divide-border">
                    @foreach($order->items as $item)
                        <li class="py-2.5 flex justify-between text-sm">
                            <span class="text-foreground">
                                {{ $item->product->name }} <span class="text-muted-foreground">x{{ $item->quantity }}</span>
                            </span>
                            <span class="font-semibold text-foreground">
                                ${{ number_format($item->unit_price * $item->quantity, 2) }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="border-t border-border pt-4 flex justify-between items-center font-extrabold text-base text-foreground">
                <span>Total Pembayaran (COD)</span>
                <span>${{ number_format($order->total_amount, 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex justify-center space-x-4">
        <a href="{{ route('products') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-semibold rounded-md text-primary-foreground bg-primary hover:bg-primary/90 transition-colors shadow-sm">
            Lanjutkan Belanja
        </a>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 border border-border text-sm font-semibold rounded-md text-muted-foreground bg-card hover:bg-muted transition-colors">
            Lihat Pesanan Saya
        </a>
    </div>
</div>
@endsection
