<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $proyek['nama_proyek'] }} - TerasDesa</title>
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
            <div class="back-link">
                <a href="{{ url('/pembangunan') }}">&larr; Kembali ke Daftar Pembangunan</a>
            </div>

            <div class="detail-wrapper">
                <div class="detail-image-box">
                    <img src="{{ $proyek['image_url'] ?? 'https://via.placeholder.com/600x400?text=Proyek+Pembangunan' }}" alt="{{ $proyek['nama_proyek'] }}">
                </div>

                <div class="detail-info-box">
                    <span class="detail-badge status-{{ strtolower(str_replace(' ', '-', $proyek['status'])) }}">
                        {{ $proyek['status'] }}
                    </span>
                    <h1>{{ $proyek['nama_proyek'] }}</h1>

                    <div class="detail-stats">
                        <div class="detail-stat-card">
                            <span class="label">Total Anggaran</span>
                            <span class="value text-green">Rp {{ number_format($proyek['anggaran'], 0, ',', '.') }}</span>
                        </div>
                        <div class="detail-stat-card">
                            <span class="label">Sumber Dana</span>
                            <span class="value">{{ $proyek['sumber_dana'] }}</span>
                        </div>
                    </div>

                    <div class="detail-progress">
                        <div class="progress-info">
                            <span>Status Pengerjaan</span>
                            <strong>{{ $proyek['progres'] }}% Selesai</strong>
                        </div>
                        <div class="progress-bar-bg-large">
                            <div class="progress-bar-large" style="width: {{ $proyek['progres'] }}%"></div>
                        </div>
                    </div>

                    <div class="detail-timeline">
                        <div class="timeline-item">
                            <span class="dot green"></span>
                            <div class="timeline-content">
                                <strong>Tanggal Mulai</strong>
                                <p>{{ date('d F Y', strtotime($proyek['tanggal_mulai'])) }}</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <span class="dot orange"></span>
                            <div class="timeline-content">
                                <strong>Target Selesai</strong>
                                <p>{{ date('d F Y', strtotime($proyek['target_selesai'])) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="detail-description">
                        <h3>Deskripsi Proyek</h3>
                        <p>{{ $proyek['deskripsi'] ?? 'Tidak ada deskripsi tambahan untuk proyek ini.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
