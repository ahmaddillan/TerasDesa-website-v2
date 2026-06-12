<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist Saya - TerasDesa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .text-teras-green { color: #7ea953; }
        .bg-teras-green { background-color: #7ea953; }
    </style>
</head>
<body class="bg-gray-50 pb-20">

    {{-- NAVBAR: Navigasi murni Back ke Marketplace --}}
    <nav class="bg-white border-b sticky top-0 z-50 py-3 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between gap-4 md:gap-8">
            
            <div class="flex items-center gap-4 flex-shrink-0">
                {{-- Tombol Back sesuai permintaan --}}
                <a href="{{ route('marketplace.index') }}" class="p-2 hover:bg-gray-100 rounded-full transition text-gray-500 hover:text-[#7ea953]" title="Kembali ke Marketplace">
                    <i class="ri-arrow-left-line text-2xl"></i>
                </a>

                <a href="{{ route('marketplace.index') }}">
                    <span class="text-2xl font-bold tracking-tight text-teras-green">TerasDesa</span>
                </a>
            </div>

            <div class="flex items-center gap-3 md:gap-4 text-gray-600">
                <a href="{{ route('wishlist.index') }}" class="relative p-2 bg-red-50 rounded-full transition group">
                    <i class="ri-heart-3-fill text-2xl text-red-500"></i>
                </a>

                <a href="{{ url('/cart') }}" class="relative p-2 hover:bg-gray-100 rounded-full transition group">
                    <i class="ri-shopping-cart-2-line text-2xl group-hover:text-[#7ea953]"></i>
                </a>

                <div class="h-8 w-px bg-gray-200 mx-1"></div>

                <div class="flex items-center gap-2 p-1 rounded-lg">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm uppercase border bg-[#f0f7ea] text-teras-green border-teras-green">
                        {{ substr(session('user_name') ?? 'T', 0, 1) }}
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-bold text-gray-700 leading-none">{{ session('user_name') ?? 'test' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-8 text-gray-800">Semua Wishlist</h1>

        <div class="flex flex-col md:flex-row gap-8">
            <aside class="w-full md:w-64 flex-shrink-0">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-4 border-b pb-2 text-sm uppercase">Filter</h3>
                    <div class="mt-4">
                        <p class="font-bold text-sm text-gray-700 mb-4">Stok</p>
                        <form action="{{ route('wishlist.index') }}" method="GET" class="space-y-4">
                            <label class="flex items-center gap-3 text-sm cursor-pointer group">
                                <input type="radio" name="stock" value="" onchange="this.form.submit()" 
                                       class="w-4 h-4 accent-[#7ea953]" {{ request('stock') == '' ? 'checked' : '' }}>
                                <span class="text-gray-600 group-hover:text-[#7ea953]">Semua</span>
                            </label>
                            <label class="flex items-center gap-3 text-sm cursor-pointer group">
                                <input type="radio" name="stock" value="available" onchange="this.form.submit()" 
                                       class="w-4 h-4 accent-[#7ea953]" {{ request('stock') == 'available' ? 'checked' : '' }}>
                                <span class="text-gray-600 group-hover:text-[#7ea953]">Tersedia</span>
                            </label>
                            <label class="flex items-center gap-3 text-sm cursor-pointer group">
                                <input type="radio" name="stock" value="empty" onchange="this.form.submit()" 
                                       class="w-4 h-4 accent-[#7ea953]" {{ request('stock') == 'empty' ? 'checked' : '' }}>
                                <span class="text-gray-600 group-hover:text-[#7ea953]">Tidak Tersedia</span>
                            </label>
                        </form>
                    </div>
                </div>
            </aside>

            <main class="flex-grow">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($items as $item)
                    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                        <a href="{{ route('marketplace.show', $item['id']) }}" class="block aspect-square bg-gray-50 overflow-hidden">
                            @php
                                $filename = !empty($item['image_url']) ? basename($item['image_url']) : null;
                                $url = $filename ? "http://localhost:3000/uploads/products/" . $filename : "https://via.placeholder.com/300";
                            @endphp
                            <img src="{{ $url }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        </a>
                        <div class="p-4">
                            <a href="{{ route('marketplace.show', $item['id']) }}">
                                <h3 class="text-sm font-medium text-gray-800 truncate mb-1 hover:text-[#7ea953]">{{ $item['name'] }}</h3>
                            </a>
                            
                            {{-- Area Harga & Tombol Toggle Hapus --}}
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-lg font-bold text-gray-900">
                                    Rp{{ number_format($item['price'], 0, ',', '.') }}
                                </div>
                                
                                {{-- Tombol Hapus (Toggle) --}}
                                <form action="{{ route('wishlist.destroy', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:scale-110 transition-transform p-1" title="Hapus dari Wishlist">
                                        <i class="ri-heart-3-fill text-xl"></i>
                                    </button>
                                </form>
                            </div>

                            <form action="{{ route('marketplace.addToCart', $item['id']) }}" method="POST">
                                @csrf
                                <input type="hidden" name="qty" value="1">
                                <button type="submit" class="w-full mt-4 py-2.5 border-2 border-[#7ea953] text-[#7ea953] font-bold rounded-xl text-xs hover:bg-[#7ea953] hover:text-white transition-all shadow-sm">
                                    + Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-32 text-center text-gray-400">
                        <i class="ri-heart-3-line text-6xl mb-4 inline-block opacity-20"></i>
                        <p class="text-lg font-medium">Wishlist kamu masih kosong.</p>
                        <a href="{{ route('marketplace.index') }}" class="mt-4 inline-block text-[#7ea953] font-bold hover:underline">
                            Mulai Cari Produk
                        </a>
                    </div>
                    @endforelse
                </div>
            </main>
        </div>
    </div>
</body>
</html>