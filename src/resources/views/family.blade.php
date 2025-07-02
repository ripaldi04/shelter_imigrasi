@extends('layouts.app')

{{-- Masukkan sidebar ke section khusus --}}
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="bg-white p-6 rounded shadow-md max-w-7xl mx-auto">
        <h2 class="text-lg font-semibold mb-4">Keluarga</h2>

        <!-- Table -->
        <div class="overflow-x-auto">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <button class="bg-gray-200 hover:bg-gray-300 text-sm px-3 py-1 rounded mr-2">Copy</button>
                    <button class="bg-gray-200 hover:bg-gray-300 text-sm px-3 py-1 rounded mr-2">Print</button>
                    <button class="bg-gray-200 hover:bg-gray-300 text-sm px-3 py-1 rounded">Excel</button>
                </div>

                <!-- Search -->
                <input type="text" placeholder="Search..." class="border rounded px-3 py-2 text-sm w-64" />
            </div>

            <table class="w-full table-auto border rounded text-sm">
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="px-4 py-2">Nama Lengkap</th>
                        <th class="px-4 py-2">Hubungan Keluarga</th>
                        <th class="px-4 py-2">NIK</th>
                        <th class="px-4 py-2">Jenis Kelamin</th>
                        <th class="px-4 py-2">Tempat, Tanggal Lahir</th>
                        <th class="px-4 py-2">Pendidikan</th>
                        <th class="px-4 py-2">Pekerjaan</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2 text-center">
                            <button onclick="document.getElementById('formModal').classList.remove('hidden')"
                                class="bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-700">+</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="9" class="text-center text-gray-500 py-4">No data available in table</td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-4 text-sm">
                <div>
                    <select class="border rounded px-2 py-1">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
                <div class="text-gray-500">0 - 0 dari 0</div>
            </div>
        </div>

        <!-- Footer Navigation -->
        <div class="flex justify-between mt-6">
            <a href="/biodata" class="px-4 py-2 rounded bg-white border text-blue-700 hover:bg-gray-100">← Sebelumnya</a>
            <button class="px-4 py-2 rounded bg-blue-800 text-white hover:bg-blue-900">Selanjutnya →</button>
        </div>
    </div>

    <!-- Modal -->
    <div id="formModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-3xl">
            <h3 class="text-lg font-semibold mb-4">Tambah Data Keluarga</h3>
            <form action="/keluarga/store" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">Nama Lengkap</label>
                        <input type="text" name="nama" class="w-full border rounded px-3 py-2" required />
                    </div>
                    <div>
                        <label class="text-sm">Hubungan Keluarga</label>
                        <input type="text" name="hubungan" class="w-full border rounded px-3 py-2" required />
                    </div>
                    <div>
                        <label class="text-sm">NIK</label>
                        <input type="text" name="nik" class="w-full border rounded px-3 py-2" />
                    </div>
                    <div>
                        <label class="text-sm">Jenis Kelamin</label>
                        <select name="gender" class="w-full border rounded px-3 py-2">
                            <option value="">- Pilih -</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="w-full border rounded px-3 py-2" />
                    </div>
                    <div>
                        <label class="text-sm">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="w-full border rounded px-3 py-2" />
                    </div>
                    <div>
                        <label class="text-sm">Pendidikan</label>
                        <input type="text" name="pendidikan" class="w-full border rounded px-3 py-2" />
                    </div>
                    <div>
                        <label class="text-sm">Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="w-full border rounded px-3 py-2" />
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm">Status</label>
                        <select name="status" class="w-full border rounded px-3 py-2">
                            <option value="Hidup">Hidup</option>
                            <option value="Meninggal">Meninggal</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end mt-4 space-x-2">
                    <button type="button" onclick="document.getElementById('formModal').classList.add('hidden')"
                        class="px-4 py-2 border rounded hover:bg-gray-100">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-700 text-white rounded hover:bg-blue-800">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
