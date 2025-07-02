

<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $user = Auth::user();
    ?>
    <div class="bg-white p-6 rounded shadow-md max-w-7xl mx-auto">
        <h2 class="text-lg font-semibold mb-4">Data Pribadi</h2>
        <form action="<?php echo e(url('/dashboard/personal/update')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <input type="hidden" name="acl_user_id" value="<?php echo e($user->id); ?>">
            <input type="hidden" name="employee_personnel_id" value="<?php echo e(optional($user->personnel)->id); ?>">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Foto -->
                <div class="md:col-span-1">
                    <div class="flex flex-col items-center">
                        <img src="<?php echo e($user->personal->photo_path ? asset('storage/' . $user->personal->photo_path) : asset('/images/default-avatar.png')); ?>"
                            class="w-32 h-40 object-cover border rounded" />
                        <p class="text-xs mt-2 text-center text-gray-500">Maksimal 2MB. JPG, PNG, JPEG</p>
                        <input type="file" name="photo_path"
                            class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    </div>
                </div>

                <!-- Form -->
                <div class="md:col-span-3 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium">Nama Lengkap *</label>
                            <input type="text" name="full_name"
                                value="<?php echo e(old('full_name', $user->personal->full_name ?? '')); ?>" required
                                class="mt-1 w-full border rounded px-3 py-2" />
                        </div>
                        <div>
                            <label class="text-sm font-medium">Tempat Lahir</label>
                            <input type="text" name="place_of_birth"
                                value="<?php echo e(old('place_of_birth', $user->personal->place_of_birth ?? '')); ?>"
                                class="mt-1 w-full border rounded px-3 py-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="text-sm font-medium">Gelar Depan</label>
                            <input type="text" name="front_title"
                                value="<?php echo e(old('front_title', $user->personal->front_title ?? '')); ?>"
                                class="mt-1 w-full border rounded px-3 py-2" />
                        </div>
                        <div>
                            <label class="text-sm font-medium">Gelar Belakang</label>
                            <input type="text" name="back_degree"
                                value="<?php echo e(old('back_degree', $user->personal->back_degree ?? '')); ?>"
                                class="mt-1 w-full border rounded px-3 py-2" />
                        </div>
                        <div>
                            <label class="text-sm font-medium">Gelar Non Akademik</label>
                            <input type="text" name="non_academic_degree"
                                value="<?php echo e(old('non_academic_degree', $user->personal->non_academic_degree ?? '')); ?>"
                                class="mt-1 w-full border rounded px-3 py-2" />
                        </div>
                        <div>
                            <label class="text-sm font-medium">Golongan Darah</label>
                            <input type="text" name="blood_type"
                                value="<?php echo e(old('blood_type', $user->personal->blood_type ?? '')); ?>"
                                class="mt-1 w-full border rounded px-3 py-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="text-sm font-medium">Jenis Kelamin</label>
                            <select name="gender" class="mt-1 w-full border rounded px-3 py-2">
                                <option value="">- Pilih -</option>
                                <option value="1"
                                    <?php echo e(old('gender', $user->personal->gender ?? '') == '1' ? 'selected' : ''); ?>>Laki-laki
                                </option>
                                <option value="0"
                                    <?php echo e(old('gender', $user->personal->gender ?? '') == '0' ? 'selected' : ''); ?>>Perempuan
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm font-medium">No. HP</label>
                            <input type="text" name="phone_number"
                                value="<?php echo e(old('phone_number', $user->personal->phone_number ?? '')); ?>"
                                class="mt-1 w-full border rounded px-3 py-2" />
                        </div>
                        <div>
                            <label class="text-sm font-medium">No. WA</label>
                            <input type="text" name="wa_number"
                                value="<?php echo e(old('wa_number', $user->personal->wa_number ?? '')); ?>"
                                class="mt-1 w-full border rounded px-3 py-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="text-sm font-medium">Telepon Rumah</label>
                            <input type="text" name="home_number"
                                value="<?php echo e(old('home_number', $user->personal->home_number ?? '')); ?>"
                                class="mt-1 w-full border rounded px-3 py-2" />
                        </div>
                        <div>
                            <label class="text-sm font-medium">Email Pribadi</label>
                            <input type="email" name="personal_email"
                                value="<?php echo e(old('personal_email', $user->personal->personal_email ?? '')); ?>"
                                class="mt-1 w-full border rounded px-3 py-2" />
                        </div>
                        <div>
                            <label class="text-sm font-medium">Alamat Identitas</label>
                            <input type="text" name="identity_address"
                                value="<?php echo e(old('identity_address', $user->personal->identity_address ?? '')); ?>"
                                class="mt-1 w-full border rounded px-3 py-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium">Alamat Tempat Tinggal</label>
                            <input type="text" name="address"
                                value="<?php echo e(old('address', $user->personal->address ?? '')); ?>"
                                class="mt-1 w-full border rounded px-3 py-2" />
                        </div>
                        <div>
                            <label class="text-sm font-medium">No. KTP</label>
                            <input type="text" name="identity_number"
                                value="<?php echo e(old('identity_number', $user->personal->identity_number ?? '')); ?>"
                                class="mt-1 w-full border rounded px-3 py-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium">No. KK</label>
                            <input type="text" name="family_identity_number"
                                value="<?php echo e(old('family_identity_number', $user->personal->family_identity_number ?? '')); ?>"
                                class="mt-1 w-full border rounded px-3 py-2" />
                        </div>
                        <div>
                            <label class="text-sm font-medium">Upload KTP <span class="text-red-500">*</span></label>

                            
                            <?php if(!empty($user->personal->identity_card_path)): ?>
                                <?php
                                    $fileUrl = asset('storage/' . $user->personal->identity_card_path);
                                    $isImage = in_array(pathinfo($fileUrl, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']);
                                ?>

                                <?php if($isImage): ?>
                                    <div class="mb-2">
                                        <img src="<?php echo e($fileUrl); ?>" alt="KTP"
                                            class="w-[325px] h-[205px] object-cover border rounded shadow-sm" />
                                    </div>
                                <?php else: ?>
                                    <div class="mb-2">
                                        <a href="<?php echo e($fileUrl); ?>" target="_blank"
                                            class="text-blue-600 underline">Lihat File KTP</a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            
                            <input type="file" name="identity_card_path"
                                class="mt-1 block w-full text-sm text-gray-500
               file:mr-4 file:py-2 file:px-4 file:rounded-md
               file:border-0 file:text-sm file:font-semibold
               file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />

                            <p class="text-xs text-gray-500 mt-1">Maks. 2 MB. JPG, JPEG, PNG, PDF</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6 space-x-3">
                <a href="/" class="px-4 py-2 rounded bg-white border text-gray-700 hover:bg-gray-100">Kembali</a>
                <button type="submit" class="px-4 py-2 rounded bg-blue-800 text-white hover:bg-blue-900">Simpan &
                    Lanjutkan</button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\project coding\filament-imipas\filament-app\src\resources\views/personal.blade.php ENDPATH**/ ?>