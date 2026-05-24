@extends('layouts.storefront')

@section('title', 'Semua Produk')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="border-b border-border pb-5 md:flex md:items-center md:justify-between">
        <h1 class="text-3xl font-extrabold tracking-tight text-foreground">Semua Produk</h1>
        <div class="mt-4 md:mt-0">
            <p class="text-sm text-muted-foreground">Menampilkan {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} hasil</p>
        </div>
    </div>

    <div class="mt-8 lg:grid lg:grid-cols-4 lg:gap-x-8">
        <!-- Sidebar filters -->
        <aside class="hidden lg:block space-y-6">
            <div>
                <h3 class="text-sm font-bold text-foreground uppercase tracking-wider">Kategori</h3>
                <ul class="mt-4 space-y-2.5">
                    <li>
                        <a href="{{ route('products', ['search' => request('search')]) }}" class="text-sm {{ !request('category') ? 'text-primary font-semibold' : 'text-muted-foreground hover:text-primary transition-colors' }}">
                            Semua Kategori
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('products', ['category' => $category->slug, 'search' => request('search')]) }}" class="text-sm {{ request('category') === $category->slug ? 'text-primary font-semibold' : 'text-muted-foreground hover:text-primary transition-colors' }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Product grid -->
        <div class="lg:col-span-3">
            <!-- Search bar (mobile specific and extra search) -->
            <div class="mb-6 md:hidden">
                <form action="{{ route('products') }}" method="GET">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}"
                            class="w-full bg-muted border-border rounded-lg py-2 pl-4 pr-10 text-sm focus:ring-primary focus:border-primary">
                        <button type="submit" class="absolute right-3 top-2.5 text-muted-foreground">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
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
                    <div class="col-span-full py-16 text-center text-muted-foreground">
                        <svg class="mx-auto h-12 w-12 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mt-2 text-lg font-bold text-foreground">Produk tidak ditemukan</h3>
                        <p class="mt-1 text-sm text-muted-foreground">Coba ubah filter atau kata kunci pencarian Anda.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
