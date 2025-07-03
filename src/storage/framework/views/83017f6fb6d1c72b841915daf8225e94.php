

<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-white p-6 rounded shadow-md max-w-7xl mx-auto">
        <h2 class="text-lg font-semibold mb-4">Rekam Jejak Pangkat/Golongan</h2>

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

            <form action="/assortment/store" method="POST" enctype="multipart/form-data">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\project coding\filament-imipas\filament-app\src\resources\views/assortment.blade.php ENDPATH**/ ?>