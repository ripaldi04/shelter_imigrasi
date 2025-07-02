@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="bg-white p-6 rounded shadow-md max-w-7xl mx-auto">
        <h2 class="text-lg font-semibold mb-4">Data Keluarga</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4 flex justify-between items-center">
            <div>
                <button class="bg-gray-200 px-3 py-1 rounded text-sm">Copy</button>
                <button class="bg-gray-200 px-3 py-1 rounded text-sm">Print</button>
                <button class="bg-gray-200 px-3 py-1 rounded text-sm">Excel</button>
            </div>
            <button onclick="document.getElementById('formModal').classList.remove('hidden')"
                class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">+ Tambah</button>
        </div>

        <table class="w-full text-sm border rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-2">Nama Lengkap</th>
                    <th class="px-3 py-2">Hubungan</th>
                    <th class="px-3 py-2">NIK</th>
                    <th class="px-3 py-2">Jenis Kelamin</th>
                    <th class="px-3 py-2">TTL</th>
                    <th class="px-3 py-2">Pendidikan</th>
                    <th class="px-3 py-2">Pekerjaan</th>
                    <th class="px-3 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($families as $family)
                    <tr>
                        <td class="px-3 py-2">{{ $family->full_name }}</td>
                        <td class="px-3 py-2">{{ $family->relationship->name ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $family->identity_number }}</td>
                        <td class="px-3 py-2">{{ $family->gender == '1' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td class="px-3 py-2">{{ $family->place_of_birth }}, {{ $family->date_of_birth }}</td>
                        <td class="px-3 py-2">{{ $family->degree->name ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $family->occupation->name ?? '-' }}</td>
                        <td class="px-3 py-2 space-x-1">
                            <!-- Edit Button -->
                            <!-- Gunakan JSON agar bisa diparsing di JS -->
                            <button onclick='openEditModal(@json($family))'
                                class="text-sm px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">Edit</button>


                            <!-- Delete Form -->
                            <form action="{{ url('/dashboard/family/delete/' . $family->id) }}" method="POST"
                                class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-sm px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500">Belum ada data keluarga.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Modal Form Tambah -->
    <div id="formModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded p-6 w-full max-w-3xl overflow-y-auto max-h-screen">
            <h3 class="text-lg font-semibold mb-4">Tambah Data Keluarga</h3>
            <form action="{{ url('/dashboard/family/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">Nama Lengkap</label>
                        <input type="text" name="full_name" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="text-sm">Hubungan</label>
                        <select name="relationship_id" class="w-full border rounded px-3 py-2" required>
                            <option value="">- Pilih -</option>
                            @foreach ($relationships as $item)
                                <option value="{{ $item->id }}">{{ $item->relationship }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">NIK</label>
                        <input type="text" name="identity_number" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Jenis Kelamin</label>
                        <select name="gender" class="w-full border rounded px-3 py-2" required>
                            <option value="1">Laki-laki</option>
                            <option value="0">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Tempat Lahir</label>
                        <input type="text" name="place_of_birth" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Pendidikan</label>
                        <select name="degree_id" class="w-full border rounded px-3 py-2">
                            <option value="">- Pilih -</option>
                            @foreach ($degrees as $item)
                                <option value="{{ $item->id }}">{{ $item->degree }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Jurusan</label>
                        <select name="field_of_study_id" class="w-full border rounded px-3 py-2">
                            <option value="">- Pilih -</option>
                            @foreach ($fields as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Pekerjaan</label>
                        <select name="occupation_id" class="w-full border rounded px-3 py-2">
                            <option value="">- Pilih -</option>
                            @foreach ($occupations as $item)
                                <option value="{{ $item->id }}">{{ $item->occupation }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Agama</label>
                        <select name="religion_id" class="w-full border rounded px-3 py-2">
                            <option value="">- Pilih -</option>
                            @foreach ($religions as $item)
                                <option value="{{ $item->id }}">{{ $item->religion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Status Pernikahan</label>
                        <select name="marital_status_id" class="w-full border rounded px-3 py-2">
                            <option value="">- Pilih -</option>
                            @foreach ($maritals as $item)
                                <option value="{{ $item->id }}">{{ $item->marital_status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Tanggal Pernikahan</label>
                        <input type="date" name="wedding_date" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Golongan Darah</label>
                        <input type="text" name="blood_type" class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm">Keterangan</label>
                        <input type="text" name="description" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">KTP</label>
                        <input type="file" name="identity_card" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">KK</label>
                        <input type="file" name="family_card" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Kartu Keluarga</label>
                        <input type="file" name="relationship_card" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Akte Lahir</label>
                        <input type="file" name="birth_certificate" class="w-full border rounded px-3 py-2">
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
    <!-- Modal Form Edit -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded p-6 w-full max-w-3xl overflow-y-auto max-h-screen">
            <h3 class="text-lg font-semibold mb-4">Edit Data Keluarga</h3>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">Nama Lengkap</label>
                        <input type="text" name="full_name" id="edit_full_name"
                            class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="text-sm">Hubungan</label>
                        <select name="relationship_id" id="edit_relationship_id" class="w-full border rounded px-3 py-2"
                            required>
                            <option value="">- Pilih -</option>
                            @foreach ($relationships as $item)
                                <option value="{{ $item->id }}">{{ $item->relationship }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">NIK</label>
                        <input type="text" name="identity_number" id="edit_identity_number"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Jenis Kelamin</label>
                        <select name="gender" id="edit_gender" class="w-full border rounded px-3 py-2" required>
                            <option value="1">Laki-laki</option>
                            <option value="0">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Tempat Lahir</label>
                        <input type="text" name="place_of_birth" id="edit_place_of_birth"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" id="edit_date_of_birth"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Pendidikan</label>
                        <select name="degree_id" id="edit_degree_id" class="w-full border rounded px-3 py-2">
                            <option value="">- Pilih -</option>
                            @foreach ($degrees as $item)
                                <option value="{{ $item->id }}">{{ $item->degree }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Jurusan</label>
                        <select name="field_of_study_id" id="edit_field_of_study_id"
                            class="w-full border rounded px-3 py-2">
                            <option value="">- Pilih -</option>
                            @foreach ($fields as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Pekerjaan</label>
                        <select name="occupation_id" id="edit_occupation_id" class="w-full border rounded px-3 py-2">
                            <option value="">- Pilih -</option>
                            @foreach ($occupations as $item)
                                <option value="{{ $item->id }}">{{ $item->occupation }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Agama</label>
                        <select name="religion_id" id="edit_religion_id" class="w-full border rounded px-3 py-2">
                            <option value="">- Pilih -</option>
                            @foreach ($religions as $item)
                                <option value="{{ $item->id }}">{{ $item->religion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Status Pernikahan</label>
                        <select name="marital_status_id" id="edit_marital_status_id"
                            class="w-full border rounded px-3 py-2">
                            <option value="">- Pilih -</option>
                            @foreach ($maritals as $item)
                                <option value="{{ $item->id }}">{{ $item->marital_status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Tanggal Pernikahan</label>
                        <input type="date" name="wedding_date" id="edit_wedding_date"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Golongan Darah</label>
                        <input type="text" name="blood_type" id="edit_blood_type"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm">Keterangan</label>
                        <input type="text" name="description" id="edit_description"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">KTP</label>
                        <input type="file" name="identity_card" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">KK</label>
                        <input type="file" name="family_card" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Kartu Keluarga</label>
                        <input type="file" name="relationship_card" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Akte Lahir</label>
                        <input type="file" name="birth_certificate" class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <div class="flex justify-end mt-4 space-x-2">
                    <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')"
                        class="px-4 py-2 border rounded hover:bg-gray-100">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-700 text-white rounded hover:bg-blue-800">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(family) {
            document.getElementById('editModal').classList.remove('hidden');

            // Set value dari semua field edit
            document.getElementById('edit_id').value = family.id;
            document.getElementById('edit_full_name').value = family.full_name;
            document.getElementById('edit_identity_number').value = family.identity_number || '';
            document.getElementById('edit_place_of_birth').value = family.place_of_birth || '';
            document.getElementById('edit_date_of_birth').value = family.date_of_birth || '';
            document.getElementById('edit_blood_type').value = family.blood_type || '';
            document.getElementById('edit_description').value = family.description || '';
            document.getElementById('edit_wedding_date').value = family.wedding_date || '';

            // Untuk select option
            document.querySelector('[name="relationship_id"]').value = family.relationship_id || '';
            document.querySelector('[name="degree_id"]').value = family.degree_id || '';
            document.querySelector('[name="field_of_study_id"]').value = family.field_of_study_id || '';
            document.querySelector('[name="religion_id"]').value = family.religion_id || '';
            document.querySelector('[name="occupation_id"]').value = family.occupation_id || '';
            document.querySelector('[name="marital_status_id"]').value = family.marital_status_id || '';
            document.querySelector('[name="gender"]').value = family.gender;

            // Update form action
            document.getElementById('editForm').action = `/dashboard/family/update/${family.id}`;
        }
    </script>
@endsection
