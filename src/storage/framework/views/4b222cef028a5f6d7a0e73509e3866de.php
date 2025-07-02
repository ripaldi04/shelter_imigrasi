    <?php
        $uri2 = Request::segment(2);
    ?>

    <aside class="w-72 bg-white border-r h-screen overflow-y-auto shadow-md">
        <div class="p-4">
            <ul class="space-y-2 text-sm">
                <li class="text-gray-500 text-xs uppercase">Menu</li>

                <li>
                    <a href="<?php echo e(url('profile/dashboard')); ?>"
                        class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-gray-100 <?php echo e($uri2 == 'dashboard' ? 'bg-gray-100 text-blue-600 font-semibold' : ''); ?>">
                        <i class="ri-dashboard-2-line"></i>
                        <span>Laman</span>
                    </a>
                </li>

                <!-- Identitas Pelamar -->
                <li x-data="{ open: <?php echo e(in_array($uri2, ['personal_data', 'biodata', 'family']) ? 'true' : 'false'); ?> }">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full px-3 py-2 rounded-md hover:bg-gray-100">
                        <span class="flex items-center gap-2">
                            <i class="ri-map-pin-line"></i>
                            <span>Identitas Pelamar</span>
                        </span>
                        <i class="ri-arrow-down-s-line" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <ul x-show="open" class="mt-1 pl-6 space-y-1 text-gray-700">
                        <li>
                            <a href="<?php echo e(url('/dashboard/biodata/edit')); ?>"
                                class="block px-2 py-1 rounded hover:bg-gray-100 <?php echo e($uri2 == 'biodata' ? 'text-blue-600 font-semibold' : ''); ?>">
                                Biodata
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('family')); ?>"
                                class="block px-2 py-1 rounded hover:bg-gray-100 <?php echo e($uri2 == 'family' ? 'text-blue-600 font-semibold' : ''); ?>">
                                Keluarga
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Rekaman Jejak Kepegawaian -->
                <li x-data="{ open: <?php echo e(in_array($uri2, ['golongan', 'jabatan', 'penugasan', 'penempatan', 'penghargaan']) ? 'true' : 'false'); ?> }">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full px-3 py-2 rounded-md hover:bg-gray-100">
                        <span class="flex items-center gap-2">
                            <i class="ri-map-pin-line"></i>
                            <span>Rekaman Jejak Kepegawaian</span>
                        </span>
                        <i class="ri-arrow-down-s-line" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <ul x-show="open" class="mt-1 pl-6 space-y-1 text-gray-700">
                        <li>
                            <a href="<?php echo e(url('assortment')); ?>"
                                class="block px-2 py-1 rounded hover:bg-gray-100 <?php echo e($uri2 == 'golongan' ? 'text-blue-600 font-semibold' : ''); ?>">
                                Pangkat/Golongan
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('occupation' . session('login_personnel_id'))); ?>"
                                class="block px-2 py-1 rounded hover:bg-gray-100 <?php echo e($uri2 == 'jabatan' ? 'text-blue-600 font-semibold' : ''); ?>">
                                Jabatan
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('assignment-track-records')); ?>"
                                class="block px-2 py-1 rounded hover:bg-gray-100 <?php echo e($uri2 == 'penugasan' ? 'text-blue-600 font-semibold' : ''); ?>">
                                Penugasan Lainnya
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('placement-track-records')); ?>"
                                class="block px-2 py-1 rounded hover:bg-gray-100 <?php echo e($uri2 == 'penempatan' ? 'text-blue-600 font-semibold' : ''); ?>">
                                Penempatan
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('reward-track-records')); ?>"
                                class="block px-2 py-1 rounded hover:bg-gray-100 <?php echo e($uri2 == 'penghargaan' ? 'text-blue-600 font-semibold' : ''); ?>">
                                Penghargaan
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Tambah menu lain seperti Riwayat Hukuman, Pendidikan, dll sesuai pola di atas -->

                <li>
                    <a href="<?php echo e(url('home/hboard')); ?>"
                        class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-gray-100 <?php echo e($uri2 == 'dashboard' ? 'bg-gray-100 text-blue-600 font-semibold' : ''); ?>">
                        <i class="ri-dashboard-2-line"></i>
                        <span>Makalah</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
<?php /**PATH D:\project coding\filament-imipas\filament-app\src\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>