<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-foreground leading-tight">
            {{ __('Dasbor Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-background">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Card -->
            <div class="bg-card border border-border overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-foreground">
                    <h3 class="text-lg font-bold">Halo, {{ Auth::user()->name }}!</h3>
                    <p class="text-sm text-muted-foreground mt-1">Melalui dasbor ini, Anda dapat memantau riwayat pesanan Anda dan mengelola profil akun Anda.</p>
                </div>
            </div>

            <!-- Orders History -->
            <div class="bg-card border border-border overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-foreground">
                    <h3 class="text-lg font-bold mb-6">Riwayat Pesanan Anda</h3>

                    @if($orders->isEmpty())
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            <p class="mt-2 text-sm text-muted-foreground">Anda belum melakukan pemesanan apa pun.</p>
                            <div class="mt-4">
                                <a href="{{ route('products') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-semibold rounded-md text-primary-foreground bg-primary hover:bg-primary/90 transition-colors">
                                    Mulai Belanja
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($orders as $order)
                                <div class="border border-border rounded-xl p-6 bg-muted/30">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-border pb-4 mb-4 space-y-2 md:space-y-0">
                                        <div>
                                            <span class="text-xs font-bold text-muted-foreground uppercase tracking-wider">ID Pesanan</span>
                                            <p class="text-sm font-bold text-foreground mt-0.5">{{ $order->id }}</p>
                                        </div>
                                        <div>
                                            <span class="text-xs font-bold text-muted-foreground uppercase tracking-wider block md:text-right">Tanggal Pemesanan</span>
                                            <p class="text-sm font-medium text-foreground mt-0.5">{{ $order->created_at->format('d M Y') }}</p>
                                        </div>
                                        <div>
                                            <span class="text-xs font-bold text-muted-foreground uppercase tracking-wider block md:text-right">Status Pesanan</span>
                                            <div class="mt-0.5">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold uppercase border
                                                    @if($order->status === 'pending') bg-amber-50 text-amber-800 border-amber-200/50
                                                    @elseif($order->status === 'processing') bg-blue-50 text-blue-800 border-blue-200/50
                                                    @elseif($order->status === 'shipped') bg-purple-50 text-purple-800 border-purple-200/50
                                                    @elseif($order->status === 'delivered') bg-green-50 text-green-800 border-green-200/50
                                                    @else bg-red-50 text-red-800 border-red-200/50 @endif">
                                                    @if($order->status === 'pending') Menunggu
                                                    @elseif($order->status === 'processing') Diproses
                                                    @elseif($order->status === 'shipped') Dikirim
                                                    @elseif($order->status === 'delivered') Diterima
                                                    @else Dibatalkan @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="text-xs font-bold text-muted-foreground uppercase tracking-wider block md:text-right">Status Pembayaran</span>
                                            <div class="mt-0.5">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold uppercase border
                                                    @if($order->payment_status === 'pending') bg-amber-50 text-amber-800 border-amber-200/50
                                                    @elseif($order->payment_status === 'paid') bg-green-50 text-green-800 border-green-200/50
                                                    @else bg-red-50 text-red-800 border-red-200/50 @endif">
                                                    @if($order->payment_status === 'pending') Belum Bayar
                                                    @elseif($order->payment_status === 'paid') Lunas
                                                    @else Gagal @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                                        <!-- Items List -->
                                        <div class="md:col-span-2 space-y-2">
                                            <span class="text-xs font-bold text-muted-foreground uppercase tracking-wider">Produk</span>
                                            <ul class="divide-y divide-border">
                                                @foreach($order->items as $item)
                                                    <li class="py-2 flex items-center justify-between text-sm">
                                                        <span class="text-foreground">
                                                            {{ $item->product->name }} <span class="text-muted-foreground font-medium">x{{ $item->quantity }}</span>
                                                        </span>
                                                        <span class="font-semibold text-foreground">${{ number_format($item->unit_price * $item->quantity, 2) }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <!-- Total Info -->
                                        <div class="bg-card p-4 rounded-lg border border-border flex flex-col justify-between items-center text-center">
                                            <span class="text-xs font-bold text-muted-foreground uppercase tracking-wider">Total Pembayaran</span>
                                            <span class="text-2xl font-extrabold text-foreground mt-1">${{ number_format($order->total_amount, 2) }}</span>
                                            <span class="text-xs text-muted-foreground mt-1">Metode: COD (Bayar di Tempat)</span>
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
