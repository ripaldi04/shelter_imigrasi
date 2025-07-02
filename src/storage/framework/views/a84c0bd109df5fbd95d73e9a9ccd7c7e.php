


<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">🎯 Progress Pendaftaran</h2>
            <p class="text-gray-600">Pastikan data identitas dan kepegawaianmu sudah lengkap.</p>
            <a href="<?php echo e(url('employee/personnel')); ?>" class="inline-block mt-4 text-sm text-blue-600 hover:underline">Periksa
                Sekarang</a>
        </div>

        
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">📢 Pengumuman Terbaru</h2>
            <p class="text-gray-600">Semua pengumuman penting terkait proses seleksi bisa kamu akses di sini.</p>
            <a href="<?php echo e(url('home/pengumuman')); ?>" class="inline-block mt-4 text-sm text-blue-600 hover:underline">Lihat
                Pengumuman</a>
        </div>

        
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">💡 Tips & Bantuan</h2>
            <p class="text-gray-600">Butuh bantuan atau panduan mengisi form? Kami siap bantu kamu.</p>
            <a href="<?php echo e(url('home/bantuan')); ?>" class="inline-block mt-4 text-sm text-blue-600 hover:underline">Pelajari
                Lebih Lanjut</a>
        </div>
    </div>

    
    <div class="mt-12 text-center text-gray-500 text-sm">
        <p>“Kesuksesan adalah hasil dari persiapan, kerja keras, dan belajar dari kegagalan.” — Colin Powell</p>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\project coding\filament-imipas\filament-app\src\resources\views/dashboard.blade.php ENDPATH**/ ?>