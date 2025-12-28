@extends('layouts.app')

@section('title', 'Pembangunan • TerasDesa')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pembangunan.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/pembangunan.js') }}" defer></script>
@endpush

@section('content')
<div class="container">
  <div class="card">
    <a href="{{ url('/homepage') }}" class="back-arrow">←</a>
    <h2 style="margin:8px 0 0;">Pembangunan</h2>
    <p class="login-link" style="margin-top:6px;">Kelola proyek pembangunan desa.</p>
  </div>

  <div class="pembangunan-grid">
    <section class="card">
      <h3 style="margin:0 0 12px">Tambah Proyek</h3>

      {{-- Ini masih frontend (JS). Kalau mau DB, nanti kita buat POST ke Laravel --}}
      <form id="proj-form" class="grid-two">
        <div>
          <label>Nama Proyek</label>
          <input id="p-name" type="text" placeholder="Contoh: Pembangunan Aula" required />
        </div>

        <div>
          <label>Status</label>
          <select id="p-status" required>
            <option value="planned">Planned</option>
            <option value="ongoing">Ongoing</option>
            <option value="completed">Completed</option>
          </select>
        </div>

        <div>
          <label>Persentase Progress (%)</label>
          <input id="p-progress" type="number" min="0" max="100" step="1" value="0" required />
        </div>

        <div>
          <label>Penanggung Jawab</label>
          <input id="p-owner" type="text" placeholder="Nama penanggung jawab" required />
        </div>

        <div>
          <label>Tanggal Mulai</label>
          <input id="p-start" type="date" required />
        </div>

        <div>
          <label>Tanggal Selesai</label>
          <input id="p-end" type="date" required />
        </div>

        <div>
          <label>Estimasi Anggaran (Rp)</label>
          <input id="p-est" type="number" step="1000" min="0" placeholder="0" required />
        </div>

        <div>
          <label>Total Anggaran (Rp)</label>
          <input id="p-total" type="number" step="1000" min="0" placeholder="0" required />
        </div>

        <div class="full">
          <label>Deskripsi</label>
          <textarea id="p-desc" placeholder="Uraian singkat pekerjaan" required></textarea>
        </div>

        <div class="full">
          <button class="btn" type="submit">Simpan Proyek</button>
        </div>
      </form>
    </section>

    <section class="card">
      <div class="row-between">
        <div class="row-gap">
          <button class="btn secondary filter-btn" data-filter="all" type="button">Semua</button>
          <button class="btn secondary filter-btn" data-filter="planned" type="button">Planned</button>
          <button class="btn secondary filter-btn" data-filter="ongoing" type="button">Ongoing</button>
          <button class="btn secondary filter-btn" data-filter="completed" type="button">Completed</button>
        </div>
        <button id="clear" class="btn secondary" type="button">Hapus Semua</button>
      </div>

      <div style="margin:12px 0">
        <div class="progress"><div id="bar" style="width:0%"></div></div>
        <div id="percent" class="percent-text">0% rata-rata progress</div>
      </div>

      <div id="list" class="list"></div>
    </section>
  </div>
</div>
@endsection
