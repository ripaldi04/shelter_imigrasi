@extends('layouts.app')

{{-- Masukkan sidebar ke section khusus --}}
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="bg-white p-6 rounded shadow-md max-w-7xl mx-auto">
        <h2 class="text-lg font-semibold mb-4">Rekam Jejak Penugasan Lainnya</h2>

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
                        <th class="px-4 py-2">Jabatan</th>
                        <th class="px-4 py-2">Jenis Penugasan</th>
                        <th class="px-4 py-2">Instansi</th>
                        <th class="px-4 py-2">Tanggal Mulai</th>
                        <th class="px-4 py-2">Tanggal Selesai</th>
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
                        <option value="50">50</option>
                    </select>
                </div>
                <div class="text-gray-500">0 - 0 dari 0</div>
            </div>
        </div>

        <!-- Footer Navigation -->
        <div class="flex justify-between mt-6">
            <a href="/jabatan" class="px-4 py-2 rounded bg-white border text-blue-700 hover:bg-gray-100">← Sebelumnya</a>
            <button class="px-4 py-2 rounded bg-blue-800 text-white hover:bg-blue-900">Selanjutnya →</button>
        </div>
    </div>

    <!-- Modal Form Tambah -->
    <div id="formModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-4xl">
            <h3 class="text-lg font-semibold mb-4">Tambah Penugasan Lainnya</h3>
            <form action="/penugasan/store" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">Jabatan</label>
                        <input type="text" name="jabatan" class="w-full border rounded px-3 py-2" required />
                    </div>
                    <div>
                        <label class="text-sm">Jenis Penugasan</label>
                        <input type="text" name="jenis_penugasan" class="w-full border rounded px-3 py-2" required />
                    </div>
                    <div>
                        <label class="text-sm">Instansi</label>
                        <input type="text" name="instansi" class="w-full border rounded px-3 py-2" />
                    </div>
                    <div>
                        <label class="text-sm">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="w-full border rounded px-3 py-2" required />
                    </div>
                    <div>
                        <label class="text-sm">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="w-full border rounded px-3 py-2" />
                    </div>
                    <div>
                        <label class="text-sm">Nomor SK</label>
                        <input type="text" name="nomor_sk" class="w-full border rounded px-3 py-2" />
                    </div>
                    <div>
                        <label class="text-sm">Tanggal SK</label>
                        <input type="date" name="tanggal_sk" class="w-full border rounded px-3 py-2" />
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm">Dokumen SK</label>
                        <input type="file" name="dokumen_sk"
                            class="block w-full text-sm text-gray-500
                               file:mr-4 file:py-2 file:px-4
                               file:rounded file:border-0
                               file:text-sm file:font-semibold
                               file:bg-blue-50 file:text-blue-700
                               hover:file:bg-blue-100" />
                        <p class="text-xs text-gray-500 mt-1">Ukuran maksimal 2 MB. Format JPG, JPEG, PNG, atau PDF.</p>
                    </div>
                    <div class="md:col-span-2">
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
