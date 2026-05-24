@extends('layouts.storefront')

@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumbs -->
    <nav class="flex mb-8 text-sm font-medium text-muted-foreground">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
        <svg class="w-4 h-4 mx-2 text-muted-foreground/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('products') }}" class="hover:text-primary transition-colors">Produk</a>
        <svg class="w-4 h-4 mx-2 text-muted-foreground/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('products', ['category' => $product->category->slug]) }}" class="hover:text-primary transition-colors">{{ $product->category->name }}</a>
    </nav>

    <!-- Product Layout -->
    <div class="lg:grid lg:grid-cols-2 lg:gap-x-12">
        <!-- Image Area -->
        <div class="flex justify-center bg-muted rounded-2xl p-8 border border-border min-h-[400px]">
            @if($product->image_url)
                <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="max-h-[500px] w-auto object-contain rounded-lg">
            @else
                <div class="flex flex-col items-center justify-center text-muted-foreground">
                    <svg class="w-24 h-24 stroke-current" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="mt-4 text-sm font-semibold">Gambar tidak tersedia</span>
                </div>
            @endif
        </div>

        <!-- Info Area -->
        <div class="mt-10 lg:mt-0 lg:pl-8 flex flex-col justify-between">
            <div>
                <span class="text-sm font-bold uppercase tracking-wider text-primary">
                    {{ $product->category->name }}
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-foreground mt-2">
                    {{ $product->name }}
                </h1>
                
                <div class="mt-6 flex items-center justify-between border-b border-border pb-6">
                    <span class="text-3xl font-extrabold text-foreground">
                        ${{ number_format($product->price, 2) }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $product->stock > 0 ? 'bg-green-100 text-green-800 dark:bg-green-950/20 dark:text-green-400' : 'bg-destructive/10 text-destructive' }}">
                        {{ $product->stock > 0 ? 'Stok Tersedia (' . $product->stock . ')' : 'Stok Habis' }}
                    </span>
                </div>

                <div class="mt-6">
                    <h3 class="text-sm font-bold text-foreground uppercase tracking-wider">Deskripsi Produk</h3>
                    <div class="mt-4 text-muted-foreground space-y-4 leading-relaxed">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
            </div>

            <!-- Action Area -->
            <div class="mt-10 pt-8 border-t border-border">
                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
                        @csrf
                        <div class="w-32">
                            <label for="quantity" class="sr-only">Jumlah</label>
                            <div class="relative rounded-md shadow-sm">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-muted-foreground text-sm font-medium">Qty</span>
                                <input type="number" name="quantity" id="quantity" min="1" max="{{ $product->stock }}" value="1"
                                    class="focus:ring-primary focus:border-primary block w-full pl-12 pr-3 py-2.5 sm:text-sm border-border bg-background rounded-md">
                            </div>
                        </div>
                        <button type="submit" class="flex-grow inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-semibold rounded-md text-primary-foreground bg-primary hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">
                            Tambah ke Keranjang
                        </button>
                    </form>
                @else
                    <button disabled class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-semibold rounded-md text-muted-foreground bg-muted cursor-not-allowed">
                        Stok Habis
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mt-24 border-t border-border pt-16">
            <h2 class="text-2xl font-extrabold text-foreground tracking-tight">Produk Terkait</h2>
            <div class="mt-8 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach($relatedProducts as $related)
                    <div class="group relative flex flex-col bg-card border border-border rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-muted group-hover:opacity-90 transition-opacity min-h-60 flex items-center justify-center">
                            @if($related->image_url)
                                <img src="{{ asset('storage/' . $related->image_url) }}" alt="{{ $related->name }}" class="h-full w-full object-cover object-center">
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
                                    {{ $related->category->name }}
                                </span>
                                <h3 class="text-lg font-bold text-foreground mt-1">
                                    <a href="{{ route('product.show', $related->slug) }}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $related->name }}
                                    </a>
                                </h3>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-xl font-extrabold text-foreground">
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
