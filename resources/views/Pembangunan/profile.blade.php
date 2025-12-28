@extends('layouts.app')

@section('title', 'Profil • TerasDesa')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/profile.js') }}" defer></script>
@endpush

@section('content')
<div class="container">
  <div class="card">

    <a href="{{ url('/homepage') }}" class="back-arrow">←</a>

    <div class="profile-header">
      <h2 style="margin:0;">Profil</h2>
      <span class="chip">{{ $user->role ?? 'User' }}</span>
    </div>

    <p class="login-link" style="margin-top:6px;">
      Kelola informasi akun kamu.
    </p>

    <div class="profile-grid">

      {{-- AVATAR --}}
      <div class="avatar-wrap">
        <img
          id="avatarPreview"
          class="avatar"
          src="{{ asset('images/kantor.jpg') }}"
          alt="avatar"
        >
        <label class="btn secondary btn-full" style="cursor:pointer;">
          Ubah Foto
          <input type="file" id="avatarInput" accept="image/*" hidden>
        </label>
      </div>

      {{-- ================= VIEW MODE ================= --}}
      <div id="viewMode">
        <div class="grid-two">

          <div class="view-item">
            <label>Nama</label>
            <p><strong>{{ $user->name }}</strong></p>
          </div>

          <div class="view-item">
            <label>Username</label>
            <p><strong>{{ $user->username ?? '-' }}</strong></p>
          </div>

          <div class="view-item">
            <label>Email</label>
            <p><strong>{{ $user->email }}</strong></p>
          </div>

          <div class="view-item">
            <label>No. HP</label>
            <p><strong>{{ $user->phone ?? '-' }}</strong></p>
          </div>

          <div class="view-item">
            <label>Alamat</label>
            <p><strong>{{ $user->address ?? '-' }}</strong></p>
          </div>

          <div class="view-item">
            <label>Notifikasi</label>
            <p><strong>{{ $user->notif ?? 'Aktif' }}</strong></p>
          </div>
        </div>

        <div class="view-item">
          <label>Bio</label>
          <p><span class="chip">{{ $user->bio ?? '—' }}</span></p>
        </div>

        <div class="row-actions">
          <button type="button" class="btn" id="btnEdit">Edit Profil</button>

          <form method="POST" action="{{ route('logout') }}" style="flex:1;">
            @csrf
            <button type="submit" class="btn secondary btn-full">Logout</button>
          </form>
        </div>
      </div>

      {{-- ================= EDIT MODE ================= --}}
      <form id="editMode"
            method="POST"
            action="{{ route('profile.update') }}"
            style="display:none;">
        @csrf
        @method('PUT')

        <div class="grid-two">
          <div>
            <label>Full Name</label>
            <input type="text" name="name" value="{{ $user->name }}" required>
          </div>

          <div>
            <label>Username</label>
            <input type="text" name="username" value="{{ $user->username ?? '' }}">
          </div>

          <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" required>
          </div>

          <div>
            <label>Phone Number</label>
            <div class="phone-field">
              <input type="tel" name="phone" value="{{ $user->phone ?? '' }}">
            </div>
          </div>

          <div>
            <label>Alamat</label>
            <input type="text" name="address" value="{{ $user->address ?? '' }}">
          </div>

          <div>
            <label>Notifikasi</label>
            <input type="text" name="notif" value="{{ $user->notif ?? 'Aktif' }}">
          </div>

          <div>
            <label>Role</label>
            <input type="text" name="role" value="{{ $user->role ?? 'User' }}">
          </div>

          <div>
            <label>Bio</label>
            <input type="text" name="bio" value="{{ $user->bio ?? '' }}">
          </div>
        </div>

        <label style="margin-top:12px;">Set Password (Opsional)</label>
        <div class="password-field">
          <input
            type="password"
            name="password"
            id="newPassword"
            placeholder="Password baru (opsional)"
          >
          <img
            src="{{ asset('assets-LoginRegister/hide.png') }}"
            class="toggle"
            onclick="togglePassword('newPassword', this)"
            alt="toggle password"
          >
        </div>

        <div class="row-actions">
          <button type="submit" class="btn">Simpan</button>
          <button type="button" class="btn secondary" id="btnCancel">Batal</button>
        </div>
      </form>

    </div>
  </div>
</div>

{{-- POPUP SUCCESS --}}
@if(session('success'))
<script>
  document.addEventListener('DOMContentLoaded', () => {
    if (typeof showPopup === 'function') {
      showPopup("✅ {{ session('success') }}");
    }
  });
</script>
@endif
@endsection
