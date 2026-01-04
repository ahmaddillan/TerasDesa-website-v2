<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Keranjang | TerasDesa</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>

<body>

    <!-- HEADER -->
    <header class="header">
        <div class="logo">TerasDesa</div>

        <div class="search-wrapper">
            <input type="text" id="searchInput" placeholder="Cari produk" class="search">
        </div>

        <div class="account">
            <span>👤</span> Akun
        </div>
    </header>

    <!-- CONTENT -->
    <div class="container">

        <!-- CART LIST -->
        <div class="cart">
            <h2>Keranjang</h2>

            <div class="select-all">
                <label>
                    <input type="checkbox" id="selectAll">
                    <span>Pilih Semua ({{ count($items) }})</span>
                </label>
            </div>

            @if(count($items) === 0)
                <p>Keranjang masih kosong</p>
            @endif

            @foreach($items as $item)
                <div class="cart-item" data-id="{{ $item['id'] }}" data-image="{{ $item['image_url'] }}"
                    data-price="{{ $item['price'] }}">

                    <!-- CHECKBOX -->
                    <input type="checkbox" class="item-checkbox" data-price="{{ $item['price'] }}" checked>

                    <!-- IMAGE -->
                    <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" width="90" style="border-radius:8px">

                    <!-- INFO -->
                    <div class="cart-info">
                        <div class="store">
                            {{ $item['name'] }}
                        </div>

                        @if(!empty($item['description']))
                            <small style="color:#666;">
                                {{ $item['description'] }}
                            </small>
                        @endif

                        @if(!empty($item['note']))
                            <div style="font-size:12px;color:#888;margin-top:4px;">
                                Catatan: {{ $item['note'] }}
                            </div>
                        @endif
                    </div>

                    <!-- QTY -->
                    <div class="qty">
                        <button class="btn-minus">-</button>
                        <span class="qty-value">{{ $item['quantity'] }}</span>
                        <button class="btn-plus">+</button>
                    </div>

                    <!-- PRICE -->
                    <div class="price">
                        <strong>Rp{{ number_format($item['price']) }}</strong>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- RINGKASAN -->
        <div class="summary">
            <h3>Ringkasan Belanja</h3>

            <p>Total: <strong id="totalPrice">Rp0</strong></p>

            <a href="/checkout" class="btn-buy">
                Beli
            </a>
        </div>


    </div>

    <script src="{{ asset('js/cart.js') }}"></script>
</body>

</html>