@extends('layouts.storefront')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-extrabold tracking-tight text-foreground mb-8">Keranjang Belanja</h1>

    @if(empty($cart))
        <div class="text-center py-16 bg-card rounded-2xl border border-border p-8 shadow-sm">
            <svg class="mx-auto h-16 w-16 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            <h2 class="mt-4 text-xl font-bold text-foreground">Keranjang belanja Anda kosong</h2>
            <p class="mt-2 text-sm text-muted-foreground">Silakan tambahkan produk ke keranjang belanja terlebih dahulu.</p>
            <div class="mt-6">
                <a href="{{ route('products') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-semibold rounded-md text-primary-foreground bg-primary hover:bg-primary/90 transition-colors">
                    Lanjutkan Belanja
                </a>
            </div>
        </div>
    @else
        <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
            <!-- Cart Items -->
            <div class="lg:col-span-8 space-y-4">
                @foreach($cart as $item)
                    <div class="flex items-center bg-card border border-border p-4 rounded-xl shadow-sm">
                        <div class="w-20 h-20 bg-muted rounded-lg flex-shrink-0 flex items-center justify-center overflow-hidden border border-border">
                            @if($item['image_url'])
                                <img src="{{ asset('storage/' . $item['image_url']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-8 h-8 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            @endif
                        </div>
                        <div class="ml-4 flex-grow flex flex-col sm:flex-row sm:justify-between">
                            <div>
                                <h3 class="text-base font-bold text-foreground">{{ $item['name'] }}</h3>
                                <p class="mt-1 text-sm text-muted-foreground">${{ number_format($item['price'], 2) }} per item</p>
                            </div>
                            <div class="mt-4 sm:mt-0 flex items-center justify-between sm:space-x-6">
                                <div class="flex items-center space-x-1">
                                    <span class="text-sm text-muted-foreground font-semibold mr-2">Jumlah: {{ $item['quantity'] }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-base font-extrabold text-foreground">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                </div>
                                <form action="{{ route('cart.remove') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                    <button type="submit" class="text-destructive hover:text-destructive/80 p-1 rounded-md hover:bg-destructive/10 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="mt-10 lg:mt-0 lg:col-span-4 bg-card border border-border rounded-xl p-6 shadow-sm sticky top-24">
                <h2 class="text-lg font-bold text-foreground border-b border-border pb-4">Ringkasan Pesanan</h2>
                <div class="mt-4 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-muted-foreground">Subtotal</span>
                        <span class="font-bold">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-muted-foreground">Pengiriman</span>
                        <span class="text-green-600 dark:text-green-400 font-semibold">Gratis</span>
                    </div>
                    <div class="border-t border-border pt-4 flex items-center justify-between text-base font-extrabold text-foreground">
                        <span>Total</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                </div>
                <div class="mt-6">
                    <a href="{{ route('checkout') }}" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-semibold rounded-md text-primary-foreground bg-primary hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20">
                        Lanjutkan ke Pembayaran
                    </a>
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('products') }}" class="text-sm font-semibold text-primary hover:text-primary/80 inline-flex items-center space-x-1 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        <span>Kembali Belanja</span>
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
