@extends('layouts.storefront')

@section('title', 'Pembayaran')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-extrabold tracking-tight text-foreground mb-8">Pembayaran</h1>

    <div class="lg:grid lg:grid-cols-12 lg:gap-x-12">
        <!-- Billing / Shipping Form -->
        <div class="lg:col-span-7">
            <div class="bg-card border border-border rounded-xl p-6 shadow-sm">
                <h2 class="text-xl font-bold text-foreground mb-6 border-b border-border pb-4">Informasi Pengiriman</h2>
                
                <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-muted-foreground">Nama Lengkap</label>
                        <input type="text" id="name" value="{{ Auth::user()->name }}" disabled
                            class="mt-1 block w-full rounded-md border-border bg-muted text-muted-foreground shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-muted-foreground">Alamat Email</label>
                        <input type="email" id="email" value="{{ Auth::user()->email }}" disabled
                            class="mt-1 block w-full rounded-md border-border bg-muted text-muted-foreground shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                    </div>

                    <div>
                        <label for="shipping_address" class="block text-sm font-semibold text-muted-foreground">Alamat Lengkap Pengiriman</label>
                        <textarea name="shipping_address" id="shipping_address" rows="4" required
                            placeholder="Masukkan alamat pengiriman lengkap Anda di sini..."
                            class="mt-1 block w-full rounded-md border-border bg-background shadow-sm focus:border-primary focus:ring-primary sm:text-sm @error('shipping_address') border-destructive @enderror">{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-muted p-4 rounded-lg border border-border">
                        <div class="flex items-center">
                            <input id="dummy_payment" type="radio" checked disabled
                                class="h-4 w-4 text-primary border-border focus:ring-primary bg-background">
                            <label for="dummy_payment" class="ml-3 block text-sm font-bold text-foreground">
                                Bayar di Tempat (COD) / Demo Flow
                            </label>
                        </div>
                        <p class="mt-1 ml-7 text-xs text-muted-foreground">Pesanan Anda akan diproses dengan status pembayaran tertunda. Tidak memerlukan detail kartu kredit asli.</p>
                    </div>

                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-semibold rounded-md text-primary-foreground bg-primary hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">
                        Buat Pesanan (${{ number_format($total, 2) }})
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="mt-10 lg:mt-0 lg:col-span-5">
            <div class="bg-card border border-border rounded-xl p-6 shadow-sm sticky top-24">
                <h2 class="text-lg font-bold text-foreground border-b border-border pb-4 mb-4">Produk dalam Pesanan</h2>
                
                <div class="flow-root">
                    <ul class="-my-4 divide-y divide-border">
                        @foreach($cart as $item)
                            <li class="py-4 flex">
                                <div class="flex-shrink-0 w-16 h-16 bg-muted rounded-md overflow-hidden flex items-center justify-center border border-border">
                                    @if($item['image_url'])
                                        <img src="{{ asset('storage/' . $item['image_url']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-6 h-6 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    @endif
                                </div>
                                <div class="ml-4 flex-1 flex flex-col justify-between">
                                    <div class="flex items-start justify-between">
                                        <h4 class="text-sm font-semibold text-foreground">{{ $item['name'] }}</h4>
                                        <p class="ml-4 text-sm font-bold text-foreground">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                    </div>
                                    <div class="flex-1 flex items-end justify-between text-xs text-muted-foreground">
                                        <p>Jumlah {{ $item['quantity'] }} @ ${{ number_format($item['price'], 2) }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-6 border-t border-border pt-6 space-y-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-muted-foreground">Subtotal</span>
                        <span class="font-semibold">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-muted-foreground">Pengiriman</span>
                        <span class="text-green-600 dark:text-green-400 font-semibold">Gratis</span>
                    </div>
                    <div class="border-t border-border pt-4 flex items-center justify-between text-base font-extrabold text-foreground">
                        <span>Total</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
