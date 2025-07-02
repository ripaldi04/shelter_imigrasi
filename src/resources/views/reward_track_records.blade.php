@extends('layouts.app')

{{-- Masukkan sidebar ke section khusus --}}
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="bg-white p-6 rounded shadow max-w-7xl mx-auto">
        <h2 class="text-lg font-semibold mb-4">Rekam Jejak Penghargaan</h2>

        <!-- Toolbar -->
        <div class="flex justify-between items-center mb-4">
            <div class="space-x-2">
                <button class="bg-gray-200 hover:bg-gray-300 text-sm px-3 py-1 rounded">Copy</button>
                <button class="bg-gray-200 hover:bg-gray-300 text-sm px-3 py-1 rounded">Print</button>
                <button class="bg-gray-200 hover:bg-gray-300 text-sm px-3 py-1 rounded">Excel</button>
            </div>
            <input type="text" placeholder="Search..." class="border rounded px-3 py-2 text-sm w-64" />
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto text-sm border rounded">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2">Penghargaan</th>
                        <th class="px-4 py-2">Jenis Penghargaan</th>
                        <th class="px-4 py-2">Instansi</th>
                        <th class="px-4 py-2">Tahun</th>
                        <th class="px-4 py-2">Pemberi SK</th>
                        <th class="px-4 py-2">Nomor SK</th>
                        <th class="px-4 py-2">Tanggal SK</th>
                        <th class="px-4 py-2">Dokumen SK</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2 text-center">
                            <button onclick="document.getElementById('formModal').classList.remove('hidden')"
                                class="bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-700">+</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="10" class="text-center text-gray-500 py-4">No data available in table</td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-4 text-sm">
                <div>
                    <select class="border rounded px-2 py-1">
                        <option value="10">10</option>
                        <option value="25">25</option>
                    </select>
                </div>
                <div class="text-gray-500">0 - 0 dari 0</div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="flex justify-between mt-6">
            <a href="/penempatan" class="px-4 py-2 rounded bg-white border text-blue-700 hover:bg-gray-100">← Sebelumnya</a>
            <button class="px-4 py-2 rounded bg-blue-800 text-white hover:bg-blue-900">Selanjutnya →</button>
        </div>
    </div>

    <!-- Modal Form -->
    <div id="formModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-5xl">
            <h3 class="text-lg font-semibold mb-4">Tambah Penghargaan</h3>
            <form action="/penghargaan/store" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">Penghargaan</label>
                        <input type="text" name="penghargaan" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="text-sm">Jenis Penghargaan</label>
                        <input type="text" name="jenis_penghargaan" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Instansi</label>
                        <input type="text" name="instansi" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Tahun</label>
                        <input type="number" name="tahun" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Pemberi SK</label>
                        <input type="text" name="pemberi_sk" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Nomor SK</label>
                        <input type="text" name="nomor_sk" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Tanggal SK</label>
                        <input type="date" name="tanggal_sk" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Dokumen SK</label>
                        <input type="file" name="dokumen_sk" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Status</label>
                        <select name="status" class="w-full border rounded px-3 py-2">
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
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
