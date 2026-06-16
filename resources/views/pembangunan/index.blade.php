<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembangunan Desa - TerasDesa</title>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pembangunan.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <header class="header">
        <div class="container header-wrapper">
            <div class="logo">
                🏠 TerasDesa
            </div>

            <nav class="nav">
                <ul>
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ url('/marketplace') }}">Marketplace</a></li>
                    <li><a href="{{ url('/aset') }}">Aset Desa</a></li>
                    <li><a href="{{ url('/pembangunan') }}" class="active">Pembangunan</a></li>
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

    <main class="main-content">
        <div class="container">
            <div class="section-header">
                <h1>🛠️ Monitoring Pembangunan Desa Nagrak</h1>
                <p>Pantau alokasi anggaran, status pengerjaan, dan transparansi progres pembangunan fisik di wilayah Desa Nagrak.</p>
                
                @if(session('role') == 'admin')
                    <div style="margin-top: 20px;">
                        <a href="{{ route('pembangunan.create') }}" class="btn btn-orange" style="display: inline-block; padding: 10px 20px; background-color: #ff8c00; color: white; text-decoration: none; border-radius: 5px; font-weight: 600;">+ Tambah Pembangunan Baru</a>
                    </div>
                @endif
            </div>

            @if(session('success'))
                <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-grid">
                @forelse($pembangunan as $proyek)
                    <div class="proyek-card">
                        <div class="proyek-image-wrapper">
                            <img src="{{ $proyek['image_url'] ?? 'https://via.placeholder.com/600x400?text=Proyek+Pembangunan' }}" alt="{{ $proyek['nama_proyek'] }}">
                            <span class="badge status-{{ strtolower(str_replace(' ', '-', $proyek['status'])) }}">
                                {{ $proyek['status'] }}
                            </span>
                        </div>
                        <div class="proyek-body">
                            <h3>{{ $proyek['nama_proyek'] }}</h3>
                            <p class="sumber-dana">💰 Sumber Dana: <strong>{{ $proyek['sumber_dana'] }}</strong></p>
                            <p class="anggaran">💵 Anggaran: <strong>Rp {{ number_format($proyek['anggaran'], 0, ',', '.') }}</strong></p>
                            
                            <div class="progress-container">
                                <div class="progress-text">
                                    <span>Progres</span>
                                    <span>{{ $proyek['progres'] }}%</span>
                                </div>
                                <div class="progress-bar-bg">
                                    <div class="progress-bar" style="width: {{ $proyek['progres'] }}%"></div>
                                </div>
                            </div>
                            
                            <div class="proyek-dates">
                                <span>📅 Mulai: {{ date('d M Y', strtotime($proyek['tanggal_mulai'])) }}</span>
                            </div>

                            <a href="{{ url('/pembangunan/' . $proyek['id']) }}" class="btn-detail-proyek">Lihat Detail &rarr;</a>
                        </div>
                    </div>
                @empty
                    <div class="no-data">
                        <p>Belum ada data proyek pembangunan yang terdaftar.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

</body>
</html>