@extends('layouts.app')

@section('title', 'Lowongan Pekerjaan')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8 animate__animated animate__fadeIn">

        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Lowongan Pekerjaan</h2>

        <!-- Filter Form -->
        <form class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <input type="text"
                class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-[#08243c]"
                placeholder="Cari posisi...">

            <select
                class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-[#08243c]">
                <option selected disabled>Lokasi</option>
                <option>Jakarta</option>
                <option>Bandung</option>
                <option>Surabaya</option>
            </select>

            <select
                class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-[#08243c]">
                <option selected disabled>Jenis Pekerjaan</option>
                <option>Pegawai Negeri Sipil</option>
                <option>PPPK</option>
                <option>Polisi</option>
                <option>Lainnya</option>
            </select>

            <button type="submit"
                class="bg-[#08243c] text-white px-4 py-2 rounded hover:bg-[#061d2f] transition duration-300 w-full">
                Cari
            </button>
        </form>

        <!-- Job List -->
        <div class="space-y-4">
            @php
                $jobs = [
                    [
                        'title' => 'Ajun Brigadir Polisi (Abrip)',
                        'position' => 'Tamtama Kepala',
                        'date' => 'Diposting 3 hari yang lalu',
                        'link' => '#',
                    ],
                    [
                        'title' => 'Brigadir Jenderal Polisi (Brigjen Pol)',
                        'position' => 'Perwira Tinggi',
                        'date' => 'Diposting 1 minggu yang lalu',
                        'link' => '#',
                    ],
                    [
                        'title' => 'Bhayangkara Satu (Bharatu)',
                        'position' => 'Tamtama Polri',
                        'date' => 'Diposting kemarin',
                        'link' => '#',
                    ],
                ];
            @endphp

            @foreach ($jobs as $job)
                <div
                    class="bg-white rounded shadow hover:shadow-md transition duration-300 p-6 flex flex-col md:flex-row justify-between items-start md:items-center animate__animated animate__fadeInUp">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">{{ $job['title'] }}</h3>
                        <p class="text-gray-500">{{ $job['position'] }}</p>
                        <span class="text-sm text-gray-400">{{ $job['date'] }}</span>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="{{ $job['link'] }}"
                            class="inline-block bg-[#08243c] text-white px-4 py-2 rounded hover:bg-[#061d2f] transition">
                            Lihat
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
