@extends('layouts.app')

{{-- Masukkan sidebar ke section khusus --}}
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    {{-- Main Content --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Info Card 1 --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">🎯 Progress Pendaftaran</h2>
            <p class="text-gray-600">Pastikan data identitas dan kepegawaianmu sudah lengkap.</p>
            <a href="{{ url('employee/personnel') }}" class="inline-block mt-4 text-sm text-blue-600 hover:underline">Periksa
                Sekarang</a>
        </div>

        {{-- Info Card 2 --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">📢 Pengumuman Terbaru</h2>
            <p class="text-gray-600">Semua pengumuman penting terkait proses seleksi bisa kamu akses di sini.</p>
            <a href="{{ url('home/pengumuman') }}" class="inline-block mt-4 text-sm text-blue-600 hover:underline">Lihat
                Pengumuman</a>
        </div>

        {{-- Info Card 3 --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">💡 Tips & Bantuan</h2>
            <p class="text-gray-600">Butuh bantuan atau panduan mengisi form? Kami siap bantu kamu.</p>
            <a href="{{ url('home/bantuan') }}" class="inline-block mt-4 text-sm text-blue-600 hover:underline">Pelajari
                Lebih Lanjut</a>
        </div>
    </div>

    {{-- Footer / Quote --}}
    <div class="mt-12 text-center text-gray-500 text-sm">
        <p>“Kesuksesan adalah hasil dari persiapan, kerja keras, dan belajar dari kegagalan.” — Colin Powell</p>
    </div>
@endsection
