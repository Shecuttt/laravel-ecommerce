@extends('layouts.storefront')

@section('title', 'Selamat Datang di Toko Premium ambilidis')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-primary text-primary-foreground py-24 sm:py-32">
    <!-- Decorative background elements -->
    <div class="absolute inset-0 bg-gradient-to-r from-primary via-primary/90 to-primary/95 opacity-95 z-0"></div>
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-accent rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center text-center z-10">
        <h1 class="text-4xl font-extrabold tracking-tight text-primary-foreground sm:text-5xl lg:text-6xl">
            Tingkatkan Gaya Hidup Anda
        </h1>
        <p class="mt-6 max-w-2xl text-xl text-primary-foreground/80">
            Jelajahi koleksi produk pilihan kami yang dirancang untuk memberikan kenyamanan, keindahan, dan fungsi terbaik bagi kehidupan Anda sehari-hari.
        </p>
        <div class="mt-10 flex space-x-4">
            <a href="{{ route('products') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-semibold rounded-md text-accent-foreground bg-accent hover:bg-accent/90 transition-all shadow-lg shadow-accent/20">
                Belanja Sekarang
            </a>
            <a href="#categories" class="inline-flex items-center justify-center px-6 py-3 border border-primary-foreground/30 text-base font-semibold rounded-md text-primary-foreground hover:bg-primary-foreground/10 transition-colors">
                Lihat Kategori
            </a>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div id="categories" class="bg-card py-16 border-b border-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-foreground tracking-tight">Kategori Pilihan</h2>
        
        <div class="mt-8 grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-3 lg:grid-cols-4 xl:gap-x-8">
            @forelse($categories as $category)
                <a href="{{ route('products', ['category' => $category->slug]) }}" class="group relative flex flex-col overflow-hidden rounded-lg border border-border bg-background p-6 hover:shadow-md transition-all">
                    <h3 class="text-lg font-bold text-foreground group-hover:text-primary transition-colors">
                        {{ $category->name }}
                    </h3>
                    <p class="mt-2 text-sm text-muted-foreground">
                        {{ Str::limit($category->description, 60) }}
                    </p>
                    <span class="mt-4 text-xs font-semibold text-primary inline-flex items-center space-x-1">
                        <span>Lihat produk</span>
                        <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </span>
                </a>
            @empty
                <div class="col-span-full py-8 text-center text-muted-foreground">
                    Kategori tidak ditemukan.
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Latest Products Section -->
<div class="bg-background py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-extrabold text-foreground tracking-tight">Produk Terbaru</h2>
            <a href="{{ route('products') }}" class="text-primary font-semibold hover:text-primary/80 text-sm inline-flex items-center space-x-1 transition-colors">
                <span>Lihat semua</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @forelse($products as $product)
                <div class="group relative flex flex-col bg-card border border-border rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-muted group-hover:opacity-90 transition-opacity min-h-60 flex items-center justify-center">
                        @if($product->image_url)
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center">
                        @else
                            <div class="flex flex-col items-center justify-center text-muted-foreground p-8">
                                <svg class="w-12 h-12 stroke-current" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="mt-2 text-xs font-semibold">Tidak ada gambar</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-semibold uppercase tracking-wider text-primary">
                                {{ $product->category->name }}
                            </span>
                            <h3 class="text-lg font-bold text-foreground mt-1">
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $product->name }}
                                </a>
                            </h3>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-xl font-extrabold text-foreground">
                                ${{ number_format($product->price, 2) }}
                            </span>
                            <span class="text-sm {{ $product->stock > 0 ? 'text-green-600' : 'text-destructive' }} font-medium">
                                {{ $product->stock > 0 ? 'Stok Tersedia' : 'Stok Habis' }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-muted-foreground">
                    Produk tidak ditemukan. Tambahkan produk di Filament Admin panel!
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
