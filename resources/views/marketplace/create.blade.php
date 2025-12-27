<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jual Barang - TerasDesa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap'); body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="{{ route('marketplace.index') }}" class="text-2xl font-bold text-green-600">TerasDesa</a>
            <a href="{{ route('marketplace.index') }}" class="text-sm text-gray-500 hover:text-green-600">Batal</a>
        </div>
    </header>

    <div class="max-w-3xl mx-auto px-4 py-8">
        
        {{-- Pesan Error/Sukses --}}
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Gagal!</strong> <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <h1 class="text-2xl font-bold mb-6">Mulai Berjualan</h1>

        <form action="{{ route('marketplace.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf 

            {{-- Upload Foto --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <label class="block font-bold mb-2">Foto Produk <span class="text-red-500">*</span></label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:bg-gray-50 transition cursor-pointer relative">
                    <input type="file" id="image" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" onchange="previewImage(event)" required>
                    <div id="placeholder">
                        <span class="text-4xl">📷</span>
                        <p class="text-sm text-gray-500 mt-2">Klik untuk upload foto</p>
                    </div>
                    <img id="preview" class="hidden max-h-48 mx-auto rounded">
                </div>
            </div>

            {{-- Informasi Produk --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 space-y-4">
                <div>
                    <label class="block text-sm font-bold mb-1">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="name" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 outline-none" placeholder="Contoh: Kripik Singkong" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold mb-1">Harga (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="price" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 outline-none" placeholder="15000" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Stok</label>
                        <input type="number" name="stock" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 outline-none" placeholder="1" value="1">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 outline-none" placeholder="Jelaskan detail produkmu..."></textarea>
                </div>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-xl hover:bg-green-700 transition shadow-lg">
                Jual Sekarang
            </button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const src = URL.createObjectURL(file);
                document.getElementById('preview').src = src;
                document.getElementById('preview').classList.remove('hidden');
                document.getElementById('placeholder').classList.add('hidden');
            }
        }
    </script>
</body>
</html>