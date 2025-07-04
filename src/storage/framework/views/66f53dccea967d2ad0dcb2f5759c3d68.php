

<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-white p-6 rounded shadow-md max-w-7xl mx-auto">
        <h2 class="text-lg font-semibold mb-4">Rekam Jejak Jabatan</h2>
        <?php if(session('success')): ?>
            <div class="bg-green-100 text-green-800 px-4 py-2 mb-4 rounded">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

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
                        <th class="px-4 py-2">Nama Jabatan</th>
                        <th class="px-4 py-2">Unit Organisasi</th>
                        <th class="px-4 py-2">Instansi</th>
                        <th class="px-4 py-2">TMT</th>
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
                    
                    <?php $__empty_1 = true; $__currentLoopData = $dataJabatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jabatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-4 py-2"><?php echo e($jabatan->position_name ?? ($jabatan->position->position ?? '-')); ?>

                            </td>
                            <td class="px-4 py-2"><?php echo e($jabatan->unit_name ?? '-'); ?></td>
                            <td class="px-4 py-2"><?php echo e($jabatan->instance ?? '-'); ?></td>
                            <td class="px-4 py-2"><?php echo e(\Carbon\Carbon::parse($jabatan->tmt_date)->translatedFormat('d M Y')); ?>

                            </td>
                            <td class="px-4 py-2"><?php echo e($jabatan->sk_number ?? '-'); ?></td>
                            <td class="px-4 py-2">
                                <?php echo e($jabatan->sk_date ? \Carbon\Carbon::parse($jabatan->sk_date)->translatedFormat('d M Y') : '-'); ?>

                            </td>
                            <td class="px-4 py-2">
                                <?php if($jabatan->document_path): ?>
                                    <a href="<?php echo e(asset('storage/' . $jabatan->document_path)); ?>" target="_blank"
                                        class="text-blue-600 underline">Lihat</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-2">
                                <span
                                    class="inline-block px-2 py-1 text-xs rounded <?php echo e($jabatan->is_internal ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'); ?>">
                                    <?php echo e($jabatan->is_internal ? 'Internal' : 'Eksternal'); ?>

                                </span>
                            </td>
                            <td class="px-4 py-2 text-center space-x-1">
                                <button onclick='openEditModal(<?php echo json_encode($jabatan, 15, 512) ?>)'
                                    class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500 text-xs">
                                    Edit
                                </button>
                                <form method="POST" action="<?php echo e(route('position.destroy', $jabatan->id)); ?>"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                        class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-xs">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="text-center text-gray-500 py-4">Tidak ada data jabatan</td>
                        </tr>
                    <?php endif; ?>
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
            <a href="/pangkat" class="px-4 py-2 rounded bg-white border text-blue-700 hover:bg-gray-100">← Sebelumnya</a>
            <button class="px-4 py-2 rounded bg-blue-800 text-white hover:bg-blue-900">Selanjutnya →</button>
        </div>
    </div>

    <!-- Modal Form Tambah -->
    <div id="formModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-3xl max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-semibold mb-4">Tambah Data Jabatan</h3>
            <form action="/dashboard/position/store" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">Jabatan</label>
                        <select name="position_id" class="w-full border rounded px-3 py-2" required>
                            <option value="">Pilih Jabatan</option>
                            <?php $__currentLoopData = $positionList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pos->id); ?>"><?php echo e($pos->position); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm">Organisasi</label>
                        <select name="organization_id" class="w-full border rounded px-3 py-2">
                            <option value="">Pilih Organisasi</option>
                            <?php $__currentLoopData = $organizationList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $org): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($org->id); ?>"><?php echo e($org->organization); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm">Grade / Golongan</label>
                        <select name="grade_id" class="w-full border rounded px-3 py-2">
                            <option value="">Pilih Grade</option>
                            <?php $__currentLoopData = $gradeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($grade->id); ?>"><?php echo e($grade->grade); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm">Kelompok Jabatan</label>
                        <select name="position_group_id" class="w-full border rounded px-3 py-2">
                            <option value="">Pilih Kelompok</option>
                            <?php $__currentLoopData = $positionGroupList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($group->id); ?>"><?php echo e($group->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm">Nama Jabatan</label>
                        <input type="text" name="position_name" class="w-full border rounded px-3 py-2" required />
                    </div>

                    <div>
                        <label class="text-sm">Unit Organisasi</label>
                        <input type="text" name="unit_name" class="w-full border rounded px-3 py-2" />
                    </div>

                    <div>
                        <label class="text-sm">Instansi</label>
                        <input type="text" name="instance" class="w-full border rounded px-3 py-2" />
                    </div>

                    <div>
                        <label class="text-sm">Tanggal TMT</label>
                        <input type="date" name="tmt_date" class="w-full border rounded px-3 py-2" required />
                    </div>

                    <div>
                        <label class="text-sm">Nomor SK</label>
                        <input type="text" name="sk_number" class="w-full border rounded px-3 py-2" />
                    </div>

                    <div>
                        <label class="text-sm">Tanggal SK</label>
                        <input type="date" name="sk_date" class="w-full border rounded px-3 py-2" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm">Dokumen SK</label>
                        <input type="file" name="document_path"
                            class="block w-full text-sm text-gray-500
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-blue-50 file:text-blue-700
                                   hover:file:bg-blue-100" />
                        <p class="text-xs text-gray-500 mt-1">Maks 2 MB, format JPG, JPEG, PNG, atau PDF.</p>
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm">Keterangan / Deskripsi</label>
                        <textarea name="description" rows="3" class="w-full border rounded px-3 py-2"></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm">Status</label>
                        <select name="is_internal" class="w-full border rounded px-3 py-2">
                            <option value="1">Internal</option>
                            <option value="0">Eksternal</option>
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
    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-3xl max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-semibold mb-4">Edit Data Jabatan</h3>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" name="id" id="edit_id">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">Jabatan</label>
                        <select name="position_id" id="edit_position_id" class="w-full border rounded px-3 py-2"
                            required>
                            <option value="">Pilih Jabatan</option>
                            <?php $__currentLoopData = $positionList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pos->id); ?>"><?php echo e($pos->position); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Organisasi</label>
                        <select name="organization_id" id="edit_organization_id" class="w-full border rounded px-3 py-2">
                            <option value="">Pilih Organisasi</option>
                            <?php $__currentLoopData = $organizationList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $org): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($org->id); ?>"><?php echo e($org->organization); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Grade / Golongan</label>
                        <select name="grade_id" id="edit_grade_id" class="w-full border rounded px-3 py-2">
                            <option value="">Pilih Grade</option>
                            <?php $__currentLoopData = $gradeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($grade->id); ?>"><?php echo e($grade->grade); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Kelompok Jabatan</label>
                        <select name="position_group_id" id="edit_position_group_id"
                            class="w-full border rounded px-3 py-2">
                            <option value="">Pilih Kelompok</option>
                            <?php $__currentLoopData = $positionGroupList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($group->id); ?>"><?php echo e($group->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Nama Jabatan</label>
                        <input type="text" name="position_name" id="edit_position_name"
                            class="w-full border rounded px-3 py-2" />
                    </div>
                    <div>
                        <label class="text-sm">Unit Organisasi</label>
                        <input type="text" name="unit_name" id="edit_unit_name"
                            class="w-full border rounded px-3 py-2" />
                    </div>
                    <div>
                        <label class="text-sm">Instansi</label>
                        <input type="text" name="instance" id="edit_instance"
                            class="w-full border rounded px-3 py-2" />
                    </div>
                    <div>
                        <label class="text-sm">Tanggal TMT</label>
                        <input type="date" name="tmt_date" id="edit_tmt_date" class="w-full border rounded px-3 py-2"
                            required />
                    </div>
                    <div>
                        <label class="text-sm">Nomor SK</label>
                        <input type="text" name="sk_number" id="edit_sk_number"
                            class="w-full border rounded px-3 py-2" />
                    </div>
                    <div>
                        <label class="text-sm">Tanggal SK</label>
                        <input type="date" name="sk_date" id="edit_sk_date"
                            class="w-full border rounded px-3 py-2" />
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm">Dokumen SK</label>
                        <input type="file" name="document_path"
                            class="block w-full text-sm text-gray-500
               file:mr-4 file:py-2 file:px-4
               file:rounded file:border-0
               file:text-sm file:font-semibold
               file:bg-blue-50 file:text-blue-700
               hover:file:bg-blue-100" />
                        <p class="text-xs text-gray-500 mt-1">Maks 2 MB, format JPG, JPEG, PNG, atau PDF.</p>

                        <div id="existingDocumentLink" class="mt-2">
                            
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm">Keterangan / Deskripsi</label>
                        <textarea name="description" id="edit_description" rows="3" class="w-full border rounded px-3 py-2"></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm">Status</label>
                        <select name="is_internal" id="edit_is_internal" class="w-full border rounded px-3 py-2">
                            <option value="1">Internal</option>
                            <option value="0">Eksternal</option>
                        </select>
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
        function openEditModal(data) {
            const modal = document.getElementById('editModal');
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_position_id').value = data.position_id;
            document.getElementById('edit_organization_id').value = data.organization_id;
            document.getElementById('edit_grade_id').value = data.grade_id;
            document.getElementById('edit_position_group_id').value = data.position_group_id;
            document.getElementById('edit_position_name').value = data.position_name || '';
            document.getElementById('edit_unit_name').value = data.unit_name || '';
            document.getElementById('edit_instance').value = data.instance || '';
            document.getElementById('edit_tmt_date').value = data.tmt_date;
            document.getElementById('edit_sk_number').value = data.sk_number || '';
            document.getElementById('edit_sk_date').value = data.sk_date || '';
            document.getElementById('edit_description').value = data.description || '';
            document.getElementById('edit_is_internal').value = data.is_internal;
            if (data.document_path) {
                document.getElementById('existingDocumentLink').innerHTML = `
        <a href="/storage/${data.document_path}" target="_blank" class="text-blue-600 underline text-sm">Lihat Dokumen Lama</a>
    `;
            } else {
                document.getElementById('existingDocumentLink').innerHTML =
                    '<p class="text-gray-400 text-sm">Belum ada dokumen</p>';
            }

            // Set action URL
            document.getElementById('editForm').action = `/dashboard/position/update/${data.id}`;

            modal.classList.remove('hidden');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\project coding\filament-imipas\filament-app\src\resources\views/position_track_records.blade.php ENDPATH**/ ?>