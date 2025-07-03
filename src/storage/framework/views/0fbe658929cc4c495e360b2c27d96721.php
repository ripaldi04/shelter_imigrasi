

<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-white p-6 rounded shadow-md max-w-7xl mx-auto">
        <h2 class="text-lg font-semibold mb-4">Rekam Jejak Pangkat/Golongan</h2>
        <?php if(session('success')): ?>
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
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
                        <th class="px-4 py-2">TMT</th>
                        <th class="px-4 py-2">Masa Kerja</th>
                        <th class="px-4 py-2">Nomor SK</th>
                        <th class="px-4 py-2">Keterangan</th>
                        <th class="px-4 py-2">Dokumen SK</th>
                        <th class="px-4 py-2">Pangkat</th>
                        <th class="px-4 py-2">Status Kepegawaian</th>
                        <th class="px-4 py-2">Jenis Kenaikan</th>
                        <th class="px-4 py-2 text-center">
                            <button onclick="document.getElementById('formModal').classList.remove('hidden')"
                                class="bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-700">+</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $trackRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-4 py-2"><?php echo e(\Carbon\Carbon::parse($record->tmt_date)->format('d-m-Y')); ?></td>
                            <td class="px-4 py-2"><?php echo e($record->work_period_year); ?> th / <?php echo e($record->work_period_month); ?> bln
                            </td>
                            <td class="px-4 py-2"><?php echo e($record->sk_number ?? '-'); ?></td>
                            <td class="px-4 py-2"><?php echo e($record->description ?? '-'); ?></td>
                            <td class="px-4 py-2">
                                <?php if($record->document_path): ?>
                                    <a href="<?php echo e(asset('storage/' . $record->document_path)); ?>" target="_blank"
                                        class="text-blue-600 hover:underline">Lihat Dokumen</a>
                                <?php else: ?>
                                    <span class="text-gray-500">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-2"><?php echo e($record->assortment->assortment ?? '-'); ?></td>
                            <td class="px-4 py-2"><?php echo e($record->employment->employment ?? '-'); ?></td>
                            <td class="px-4 py-2"><?php echo e($record->promotionType->name ?? '-'); ?></td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <button onclick="openEditModal(<?php echo e(json_encode($record)); ?>)"
                                    class="text-blue-600 hover:underline text-sm">
                                    Edit
                                </button>
                                <form action="<?php echo e(route('assortment.delete', $record->id)); ?>" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                                </form>
                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="text-center text-gray-500 py-4">Belum ada data.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

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
            <a href="/keluarga" class="px-4 py-2 rounded bg-white border text-blue-700 hover:bg-gray-100">← Sebelumnya</a>
            <button class="px-4 py-2 rounded bg-blue-800 text-white hover:bg-blue-900">Selanjutnya →</button>
        </div>
    </div>

    <!-- Modal Form Tambah -->
    <div id="formModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-3xl max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Rekam Jejak Pangkat/Golongan</h3>
                <button onclick="document.getElementById('formModal').classList.add('hidden')"
                    class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>

            <form action="/dashboard/assortment/store" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="text-sm font-medium">Tanggal TMT</label>
                        <input type="date" name="tmt_date" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div>
                        <label class="text-sm font-medium">Masa Kerja (Bulan)</label>
                        <input type="text" name="work_period_month" class="w-full border rounded px-3 py-2"
                            maxlength="10">
                    </div>

                    <div>
                        <label class="text-sm font-medium">Masa Kerja (Tahun)</label>
                        <input type="text" name="work_period_year" class="w-full border rounded px-3 py-2"
                            maxlength="10">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm font-medium">Nomor SK</label>
                        <input type="text" name="sk_number" class="w-full border rounded px-3 py-2" maxlength="150">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm font-medium">Keterangan</label>
                        <textarea name="description" class="w-full border rounded px-3 py-2" rows="2"></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm font-medium">Dokumen SK</label>
                        <input type="file" name="document_path"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-xs text-gray-500 mt-1">
                            Maksimal 2 MB. Format: JPG, JPEG, PNG, PDF.
                        </p>
                    </div>

                    <div>
                        <label class="text-sm font-medium">Pangkat/Golongan</label>
                        <select name="assortment_id" class="w-full border rounded px-3 py-2" required>
                            <option value="">- Pilih Pangkat -</option>
                            <?php $__currentLoopData = $assortments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->assortment); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-medium">Status Kepegawaian</label>
                        <select name="employment_id" class="w-full border rounded px-3 py-2" required>
                            <option value="">- Pilih Status -</option>
                            <?php $__currentLoopData = $employments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->employment); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm font-medium">Jenis Kenaikan Pangkat</label>
                        <select name="promotion_type_id" class="w-full border rounded px-3 py-2" required>
                            <option value="">- Pilih Jenis Kenaikan -</option>
                            <?php $__currentLoopData = $promotionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                </div>

                <div class="flex justify-end mt-6 space-x-2">
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
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Edit Rekam Jejak Pangkat/Golongan</h3>
                <button onclick="document.getElementById('editModal').classList.add('hidden')"
                    class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>

            <form id="editForm" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" name="id" id="edit_id">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="text-sm font-medium">Tanggal TMT</label>
                        <input type="date" name="tmt_date" id="edit_tmt_date" class="w-full border rounded px-3 py-2"
                            required>
                    </div>

                    <div>
                        <label class="text-sm font-medium">Masa Kerja (Bulan)</label>
                        <input type="number" name="work_period_month" id="edit_work_period_month"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="text-sm font-medium">Masa Kerja (Tahun)</label>
                        <input type="number" name="work_period_year" id="edit_work_period_year"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm font-medium">Nomor SK</label>
                        <input type="text" name="sk_number" id="edit_sk_number"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm font-medium">Keterangan</label>
                        <textarea name="description" id="edit_description" class="w-full border rounded px-3 py-2" rows="2"></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm font-medium">Dokumen SK (opsional)</label>
                        <input type="file" name="document_path"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <div>
                        <label class="text-sm font-medium">Pangkat/Golongan</label>
                        <select name="assortment_id" id="edit_assortment_id" class="w-full border rounded px-3 py-2">
                            <?php $__currentLoopData = $assortments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->assortment); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-medium">Status Kepegawaian</label>
                        <select name="employment_id" id="edit_employment_id" class="w-full border rounded px-3 py-2">
                            <?php $__currentLoopData = $employments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->employment); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm font-medium">Jenis Kenaikan Pangkat</label>
                        <select name="promotion_type_id" id="edit_promotion_type_id"
                            class="w-full border rounded px-3 py-2">
                            <?php $__currentLoopData = $promotionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end mt-6 space-x-2">
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
            document.getElementById('editModal').classList.remove('hidden');

            document.getElementById('editForm').action = `/dashboard/assortment/update/${data.id}`;
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_tmt_date').value = data.tmt_date;
            document.getElementById('edit_work_period_month').value = data.work_period_month;
            document.getElementById('edit_work_period_year').value = data.work_period_year;
            document.getElementById('edit_sk_number').value = data.sk_number ?? '';
            document.getElementById('edit_description').value = data.description ?? '';
            document.getElementById('edit_assortment_id').value = data.assortment_id;
            document.getElementById('edit_employment_id').value = data.employment_id;
            document.getElementById('edit_promotion_type_id').value = data.promotion_type_id;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\project coding\filament-imipas\filament-app\src\resources\views/assortment_track_records.blade.php ENDPATH**/ ?>