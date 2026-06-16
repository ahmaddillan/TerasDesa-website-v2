<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TerasDesa - Pasar Pilihan Desa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .text-teras-green { color: #7ea953; }
        .bg-teras-green { background-color: #7ea953; }
        .border-teras-green { border-color: #7ea953; }
        .bg-teras-orange { background-color: #f9a01b; }
        .hover-teras-green:hover { background-color: #6a9144; }
    </style>
</head>
<body class="bg-gray-50 pb-20">

    <nav class="bg-white border-b sticky top-0 z-50 py-3 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between gap-4 md:gap-8">
            <div class="flex items-center gap-4 flex-shrink-0">
                <a href="/" class="p-2 hover:bg-gray-100 rounded-full transition text-gray-500 hover:text-[#7ea953]">
                    <i class="ri-home-4-line text-2xl"></i>
                </a>
                <a href="{{ url('/') }}">
                    <span class="text-2xl font-bold tracking-tight text-teras-green">TerasDesa</span>
                </a>
            </div>

            <form action="{{ route('marketplace.index') }}" method="GET" class="flex-grow max-w-2xl relative group">
                <i class="ri-search-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#7ea953]"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari produk desa unggulan..." 
                       class="w-full pl-10 pr-4 py-2 bg-gray-100 border border-transparent rounded-lg focus:outline-none focus:bg-white focus:border-[#7ea953] transition-all text-sm">
            </form>

            <div class="flex items-center gap-3 md:gap-4 text-gray-600">
                <a href="{{ route('wishlist.index') }}" class="relative p-2 hover:bg-gray-100 rounded-full transition group"><i class="ri-heart-3-line text-2xl group-hover:text-red-500"></i></a>
                <a href="{{ url('/cart') }}" class="relative p-2 hover:bg-gray-100 rounded-full transition group"><i class="ri-shopping-cart-2-line text-2xl group-hover:text-[#7ea953]"></i></a>
                <a href="{{ url('/transaksi') }}" class="p-2 hover:bg-gray-100 rounded-full transition group"><i class="ri-file-list-3-line text-2xl group-hover:text-[#7ea953]"></i></a>
                <div class="h-8 w-px bg-gray-200 mx-1"></div>
                <div class="flex items-center gap-2 p-1 rounded-lg">
                    <div class="user-area">
                <a href="{{ url('/profile') }}" class="btn btn-outline-success rounded-pill" style="display: flex; align-items: center; gap: 8px;">
                    
                    @if(session()->has('user_photo') && session('user_photo') != null)
                        <img src="http://localhost:3000/{{ session('user_photo') }}" alt="Foto Profil" style="width: 28px; height: 28px; border-radius: 50%; object-fit: cover;">
                    @else
                        <span>👤</span>
                    @endif

                    {{ session('user_name', 'Guest') }}
                </a>
            </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 mt-6">
        <div class="relative rounded-2xl overflow-hidden shadow-lg h-48 md:h-64 flex items-center bg-teras-green">
            <div class="relative z-10 pl-8 md:pl-16 w-full md:w-2/3">
                <h2 class="text-2xl md:text-4xl font-extrabold text-white leading-tight">Yuk, belanja di TerasDesa</h2>
                <p class="text-white text-sm md:text-lg mt-2 opacity-95">Cek barang asli dari berbagai desa unggulan</p>
            </div>
            <div class="absolute right-0 bottom-0 top-0 hidden md:flex items-center justify-end w-1/2 pr-12 opacity-10">
                <i class="ri-store-2-fill text-[180px] text-white"></i>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex items-center gap-2 mb-6">
            <h2 class="text-xl font-bold text-gray-800 tracking-tight">
                {{ request('search') ? 'Hasil Pencarian: "'.request('search').'"' : 'Rekomendasi Pilihan' }}
            </h2>
            <div class="h-1 flex-grow bg-gray-100 rounded-full"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
            @forelse($products as $item)
                <div class="bg-white border border-gray-100 rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <a href="{{ route('marketplace.show', $item['id']) }}" class="block">
                        <div class="aspect-square bg-gray-50 flex items-center justify-center overflow-hidden">
                            @php
                                $filename = !empty($item['image_url']) ? basename($item['image_url']) : null;
                                $url = $filename ? "http://localhost:3000/uploads/products/" . $filename : "https://via.placeholder.com/300?text=No+Image";
                            @endphp
                            <img src="{{ $url }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://via.placeholder.com/300?text=Error'">
                        </div>
                        <div class="p-4 border-t border-gray-50">
                            <h3 class="text-sm font-medium text-gray-700 truncate mb-1 group-hover:text-teras-green transition">{{ $item['name'] }}</h3>
                            <div class="text-lg font-bold text-gray-900">Rp{{ number_format($item['price'], 0, ',', '.') }}</div>
                            <div class="flex items-center gap-1 mt-2 text-xs text-gray-400">
                                <i class="ri-map-pin-2-fill text-teras-green"></i>
                                <span>Desa Nagrak</span>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-20 opacity-40 text-center">
                    <i class="ri-search-2-line text-6xl text-teras-green"></i>
                    <p class="mt-4 font-medium text-lg">Produk "{{ request('search') }}" tidak ditemukan.</p>
                    <a href="{{ route('marketplace.index') }}" class="mt-2 text-sm text-teras-green underline">Tampilkan semua produk</a>
                </div>
            @endforelse
        </div>
    </div>

    <a href="{{ route('marketplace.create') }}" class="fixed bottom-8 right-8 text-white flex items-center gap-2 px-6 py-4 rounded-full font-bold shadow-2xl hover:scale-105 active:scale-95 transition-all z-50 group bg-teras-green hover-teras-green">
        <i class="ri-add-line text-2xl group-hover:rotate-90"></i>
        <span>Mulai Jual</span>
    </a>

</body>
</html>