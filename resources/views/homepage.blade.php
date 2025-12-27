<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Nagrak - Teras Desa</title>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <header class="header">
        <div class="container header-wrapper">
            <div class="logo">
                🏠 Teras Desa
            </div>

            <nav class="nav">
                <ul>
                    <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
                    <li><a href="{{ url('/marketplace') }}">Marketplace</a></li>
                    <li><a href="{{ url('/aset') }}">Aset Desa</a></li>
                    <li><a href="{{ url('/pembangunan') }}">Pembangunan</a></li>
                </ul>
            </nav>

            <div class="user-area">
                <span class="username">👤 {{ session('user_name', 'Guest') }}</span>
                <form action="{{ url('/logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <section class="bagianAtas">
        <div class="container">
            <div class="bagianAtas-text">
                <h1>Selamat Datang di Teras Desa</h1>
                <p>Platform digital untuk Desa Nagrak. Jual produk lokal, kelola aset desa bersama, dan pantau pembangunan komunitas kami dengan mudah dan transparan.</p>
                <div class="btn-group">
                    <a href="{{ url('/marketplace') }}" class="btn btn-orange">Mulai Berjualan &rarr;</a>
                    <a href="{{ url('/pembangunan') }}" class="btn btn-white-outline">Lihat Pembangunan</a>
                </div>
            </div>

            <div class="bagianAtas-image">
                <div class="bagianAtas-image-box">
                    <div class="tag">Nagrak Digital</div>
                    <div class="icon">🏘️</div>
                    <a href="{{ url('/aset') }}" class="btn btn-white">📊 Data Aset</a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <div class="section-title">
                <h2>Fitur Utama Teras Desa</h2>
                <p>Tiga pilar utama untuk mengembangkan Desa Nagrak secara bersama-sama.</p>
            </div>

            <div class="features-wrapper">
                <div class="feature-column">
                    <div class="feature-box">
                        <div class="card-icon">🛒</div>
                        <h3>Marketplace Desa Nagrak</h3>
                        <p>Jual produk lokal terbaik langsung dari hasil tani dan UMKM Desa Nagrak.</p>
                        <a href="{{ url('/marketplace') }}" class="card-link">Jelajahi Marketplace &rarr;</a>
                    </div>
                </div>

                <div class="feature-column">
                    <div class="feature-box">
                        <div class="card-icon">🏦</div>
                        <h3>Aset Desa Nagrak</h3>
                        <p>Kelola dan pantau semua aset Desa Nagrak dengan transparan. Dari tanah, bangunan...</p>
                        <a href="{{ url('/aset') }}" class="card-link">Lihat Aset Desa &rarr;</a>
                    </div>
                </div>

                <div class="feature-column">
                    <div class="feature-box">
                        <div class="card-icon">🛠️</div>
                        <h3>Pembangunan Nagrak</h3>
                        <p>Pantau progres pembangunan Desa Nagrak secara real-time. Lihat alokasi dana...</p>
                        <a href="{{ url('/pembangunan') }}" class="card-link">Pantau Pembangunan &rarr;</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="container">
            <div class="stat-item">
                <div class="number" id="stat-penduduk">0</div>
                <div class="label">Penduduk Nagrak</div>
            </div>
            <div class="stat-item">
                <div class="number" id="stat-produk">0</div>
                <div class="label">Produk Lokal</div>
            </div>
            <div class="stat-item">
                <div class="number" id="stat-pengrajin">0</div>
                <div class="label">Keluarga Pengrajin</div>
            </div>
            <div class="stat-item">
                <div class="number" id="stat-proyek">0</div>
                <div class="label">Proyek Aktif</div>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>

    <section class="cta">
        <div class="container">
            <h2>Mari Berkembang Bersama Teras Desa</h2>
            <p>Wujudkan impian Desa Nagrak yang maju dengan memanfaatkan platform digital kami</p>
        </div>
    </section>

    <script src="{{ asset('js/homepage.js') }}"></script>
</body>
</html>