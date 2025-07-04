@extends('layouts.app')

@section('title', 'Pengumuman Hasil Seleksi')

@section('content')
    @php
        $all_pengumuman = [
            [
                'nip' => '19870101 202001 1 001',
                'nama' => 'Andi',
                'jabatan' => 'Programmer',
                'unit_kerja' => 'Diskominfo',
                'asal_instansi' => 'Pemprov A',
                'nilai' => 89,
                'kategori' => 'Sangat Baik',
                'periode' => '2023',
            ],
            [
                'nip' => '19870202 202002 1 002',
                'nama' => 'Budi',
                'jabatan' => 'Designer',
                'unit_kerja' => 'Dinas Pendidikan',
                'asal_instansi' => 'Pemprov B',
                'nilai' => 85,
                'kategori' => 'Baik',
                'periode' => '2023',
            ],
            [
                'nip' => '19870303 202003 1 003',
                'nama' => 'Citra',
                'jabatan' => 'Programmer',
                'unit_kerja' => 'Bappeda',
                'asal_instansi' => 'Pemprov A',
                'nilai' => 92,
                'kategori' => 'Sangat Baik',
                'periode' => '2024',
            ],
            [
                'nip' => '19870404 202004 1 004',
                'nama' => 'Dedi',
                'jabatan' => 'Analyst',
                'unit_kerja' => 'BKD',
                'asal_instansi' => 'Pemprov C',
                'nilai' => 78,
                'kategori' => 'Cukup',
                'periode' => '2024',
            ],
            [
                'nip' => '19870505 202005 1 005',
                'nama' => 'Eka',
                'jabatan' => 'Tester',
                'unit_kerja' => 'Dinkes',
                'asal_instansi' => 'Pemprov B',
                'nilai' => 88,
                'kategori' => 'Baik',
                'periode' => '2025',
            ],
        ];

        $list_periode = ['2023', '2024', '2025'];
        $selected_periode = request('periode');

        $pengumuman =
            $selected_periode && in_array($selected_periode, $list_periode)
                ? array_filter($all_pengumuman, fn($item) => $item['periode'] === $selected_periode)
                : $all_pengumuman;

        usort($pengumuman, fn($a, $b) => $b['nilai'] <=> $a['nilai']);
    @endphp

    <div class="max-w-screen-xl mx-auto p-6 animate__animated animate__fadeIn">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800">📢 Pengumuman Hasil Seleksi</h2>
            <p class="text-gray-600 mt-2">
                Daftar peserta yang dinyatakan <span class="text-[#08243c] font-semibold">LOLOS</span> seleksi terbuka.
            </p>
        </div>

        <form method="GET" class="flex flex-wrap justify-center items-center gap-4 mb-6">
            <label for="periode" class="text-sm text-gray-700">Filter Periode:</label>
            <select name="periode" id="periode"
                class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-[#08243c] focus:outline-none">
                <option value="">Semua Periode</option>
                @foreach ($list_periode as $periode)
                    <option value="{{ $periode }}" {{ $selected_periode === $periode ? 'selected' : '' }}>
                        {{ $periode }}
                    </option>
                @endforeach
            </select>
            <button type="submit"
                class="bg-[#08243c] text-white text-sm px-4 py-2 rounded hover:bg-[#061d2f] transition duration-300">
                Filter
            </button>
        </form>

        <div class="overflow-auto bg-white rounded-lg shadow-md animate__animated animate__fadeInUp">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-[#08243c] text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">#</th>
                        <th class="px-4 py-2 text-left">NIP</th>
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">Jabatan</th>
                        <th class="px-4 py-2 text-left">Unit Kerja</th>
                        <th class="px-4 py-2 text-left">Instansi</th>
                        <th class="px-4 py-2 text-center">Nilai</th>
                        <th class="px-4 py-2 text-center">Kategori</th>
                        <th class="px-4 py-2 text-center">Periode</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($pengumuman as $i => $row)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center font-medium text-gray-700">{{ $i + 1 }}</td>
                            <td class="px-4 py-2">{{ $row['nip'] }}</td>
                            <td class="px-4 py-2">{{ $row['nama'] }}</td>
                            <td class="px-4 py-2">{{ $row['jabatan'] }}</td>
                            <td class="px-4 py-2">{{ $row['unit_kerja'] }}</td>
                            <td class="px-4 py-2">{{ $row['asal_instansi'] }}</td>
                            <td class="px-4 py-2 text-center font-bold text-[#08243c]">{{ $row['nilai'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $row['kategori'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $row['periode'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-4 text-center text-gray-500">Tidak ada data tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="text-center mt-8">
            <a href="{{ url('/') }}"
                class="inline-block bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition duration-300">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
@endsection
