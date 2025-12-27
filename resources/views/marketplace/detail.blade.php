<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product['name'] }} - TerasDesa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .text-teras-green { color: #7ea953; }
        .bg-teras-green { background-color: #7ea953; }
        .border-teras-green { border-color: #7ea953; }
        .hover-teras-green:hover { background-color: #6a9144; }
    </style>
</head>
<body class="bg-gray-50 pb-10">

    {{-- NAVBAR: Navigasi murni ke Page Wishlist --}}
    <nav class="bg-white border-b sticky top-0 z-50 py-3 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('marketplace.index') }}" class="text-gray-500 hover:text-[#7ea953] transition" title="Kembali ke Marketplace">
                    <i class="ri-arrow-left-line text-2xl"></i>
                </a>
                <span class="text-xl font-bold text-teras-green">TerasDesa</span>
            </div>

            <div class="flex items-center gap-6 text-gray-600">
                {{-- Hanya Link Navigasi --}}
                <a href="{{ route('wishlist.index') }}" class="p-2 hover:bg-gray-100 rounded-full transition group" title="Buka Page Wishlist">
                    <i class="ri-heart-3-line text-2xl group-hover:text-red-500"></i>
                </a>
                <a href="#" class="relative p-2 hover:bg-gray-100 rounded-full transition group" title="Keranjang">
                    <i class="ri-shopping-cart-2-line text-2xl group-hover:text-[#7ea953]"></i>
                </a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-10">
            
            {{-- BAGIAN GAMBAR --}}
            <div class="md:col-span-5">
                <div class="sticky top-24">
                    <div class="aspect-square bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm relative flex items-center justify-center">
                        @php
                            $filename = !empty($product['image_url']) ? basename($product['image_url']) : null;
                            $displayImage = $filename ? "http://localhost:3000/uploads/products/" . $filename : "https://via.placeholder.com/600";
                        @endphp
                        <img src="{{ $displayImage }}" class="w-full h-full object-contain p-4">
                        <div class="absolute top-4 left-4 bg-black/50 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs font-bold">
                            Stok: {{ $product['stock'] }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- BAGIAN INFO & AKSI --}}
            <div class="md:col-span-7">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <h1 class="text-3xl font-bold text-gray-900 leading-tight">{{ $product['name'] }}</h1>
                    <div class="text-4xl font-extrabold text-teras-green mt-4">Rp{{ number_format($product['price'], 0, ',', '.') }}</div>
                    
                    <div class="mt-8 border-t border-b py-6">
                        <h3 class="font-bold text-gray-800 text-sm uppercase tracking-wider mb-2">Deskripsi Produk</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $product['description'] ?? 'Tidak ada deskripsi.' }}</p>
                    </div>

                    {{-- FORM 1: KERANJANG --}}
                    <form action="{{ route('marketplace.addToCart', $product['id']) }}" method="POST" class="mt-8">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Catatan untuk Penjual</label>
                            <textarea name="note" rows="2" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-[#7ea953] outline-none text-sm" placeholder="Contoh: Ukuran XL, warna merah..."></textarea>
                        </div>

                        <div class="flex flex-wrap items-center gap-4">
                            <div class="flex items-center border border-gray-300 rounded-xl p-1 bg-gray-50">
                                <button type="button" class="w-10 h-10 font-bold" onclick="updateQty(-1)">-</button>
                                <input type="number" id="qtyInput" name="qty" value="1" min="1" max="{{ $product['stock'] }}" class="w-12 text-center bg-transparent font-bold outline-none">
                                <button type="button" class="w-10 h-10 font-bold" onclick="updateQty(1)">+</button>
                            </div>

                            <button type="submit" class="flex-grow bg-teras-green text-white font-bold py-3.5 rounded-xl hover:bg-[#6a9144] shadow-lg transition">
                                <i class="ri-shopping-cart-2-line mr-2"></i> Tambah ke Keranjang
                            </button>
                        </div>
                    </form>

                    {{-- FORM 2: TOGGLE WISHLIST (TAMBAH/HAPUS) --}}
                    <div class="mt-4">
                        @if($isWishlisted)
                            {{-- Jika Produk Sudah Ada di Wishlist: Tombol Merah Permanen untuk Hapus --}}
                            <form action="{{ route('wishlist.destroy', $product['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-3 flex items-center justify-center gap-2 border-2 border-red-500 bg-red-50 text-red-600 rounded-xl font-bold transition duration-300 shadow-sm">
                                    <i class="ri-heart-3-fill text-xl"></i> Hapus dari Wishlist
                                </button>
                            </form>
                        @else
                            {{-- Jika Produk Belum Ada: Tombol Simpan Default (Abu-abu) --}}
                            <form action="{{ route('wishlist.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                <button type="submit" class="w-full py-3 flex items-center justify-center gap-2 border-2 border-gray-100 rounded-xl text-gray-500 hover:text-red-500 hover:border-red-500 transition duration-300 font-bold">
                                    <i class="ri-heart-3-line text-xl"></i> Simpan ke Wishlist
                                </button>
                            </form>
                        @endif
                    </div>

                    @if(isset($currentUserId) && $currentUserId == $product['user_id'])
                        <div class="mt-6 pt-6 border-t">
                            <form action="{{ route('marketplace.destroy', $product['id']) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button class="w-full py-3 bg-red-50 text-red-600 font-bold rounded-xl hover:bg-red-100 transition">Hapus Produk Saya</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateQty(change) {
            const input = document.getElementById('qtyInput');
            let val = parseInt(input.value) + change;
            const max = parseInt(input.getAttribute('max'));
            if(val >= 1 && val <= max) {
                input.value = val;
            }
        }
    </script>
</body>
</html>