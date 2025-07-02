

<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-white p-6 rounded shadow-md max-w-7xl mx-auto">
        <h2 class="text-lg font-semibold mb-4">Data Keluarga</h2>

        <?php if(session('success')): ?>
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

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
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $families; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $family): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-3 py-2"><?php echo e($family->full_name); ?></td>
                        <td class="px-3 py-2"><?php echo e($family->relationship->name ?? '-'); ?></td>
                        <td class="px-3 py-2"><?php echo e($family->identity_number); ?></td>
                        <td class="px-3 py-2"><?php echo e($family->gender == '1' ? 'Laki-laki' : 'Perempuan'); ?></td>
                        <td class="px-3 py-2"><?php echo e($family->place_of_birth); ?>, <?php echo e($family->date_of_birth); ?></td>
                        <td class="px-3 py-2"><?php echo e($family->degree->name ?? '-'); ?></td>
                        <td class="px-3 py-2"><?php echo e($family->occupation->name ?? '-'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500">Belum ada data keluarga.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Form Tambah -->
    <div id="formModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded p-6 w-full max-w-3xl overflow-y-auto max-h-screen">
            <h3 class="text-lg font-semibold mb-4">Tambah Data Keluarga</h3>
            <form action="<?php echo e(url('/dashboard/family/update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">Nama Lengkap</label>
                        <input type="text" name="full_name" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="text-sm">Hubungan</label>
                        <select name="relationship_id" class="w-full border rounded px-3 py-2" required>
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $relationships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->relationship); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <?php $__currentLoopData = $degrees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->degree); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Jurusan</label>
                        <select name="field_of_study_id" class="w-full border rounded px-3 py-2">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Pekerjaan</label>
                        <select name="occupation_id" class="w-full border rounded px-3 py-2">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $occupations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->occupation); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Agama</label>
                        <select name="religion_id" class="w-full border rounded px-3 py-2">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $religions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->religion); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Status Pernikahan</label>
                        <select name="marital_status_id" class="w-full border rounded px-3 py-2">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $maritals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->marital_status); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\project coding\filament-imipas\filament-app\src\resources\views/family.blade.php ENDPATH**/ ?>