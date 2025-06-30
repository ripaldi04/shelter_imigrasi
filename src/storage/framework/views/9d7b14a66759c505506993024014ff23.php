

<?php $__env->startSection('content'); ?>
    <div id="carousel" class="relative w-full h-[500px] overflow-hidden">
        <!-- Slides -->
        <div class="absolute inset-0 transition-opacity duration-1000 animate__animated animate__fadeIn z-10"
            style="background-image: url('https://source.unsplash.com/random/1600x500?nature'); background-size: cover;">
            <div class="flex items-center justify-center h-full bg-black bg-opacity-50 text-center p-4">
                <div>
                    <h1 class="text-white text-4xl font-bold mb-4 animate__animated animate__fadeInDown">Selamat Datang
                        di SELTER</h1>
                    <p class="text-white mb-2">SELTER (Seleksi Terbuka...) dst.</p>
                    <p class="text-white">Akses informasi pengumuman... dst.</p>
                </div>
            </div>
        </div>
        <!-- Slide 2 & 3, dll... -->
        <!-- Controls -->
        <div class="absolute top-1/2 left-4 transform -translate-y-1/2 z-20">
            <button id="prev" class="bg-white rounded-full p-2 shadow-md hover:scale-110 transition">&#8592;</button>
        </div>
        <div class="absolute top-1/2 right-4 transform -translate-y-1/2 z-20">
            <button id="next" class="bg-white rounded-full p-2 shadow-md hover:scale-110 transition">&#8594;</button>
        </div>
    </div>

    <script>
        const slides = document.querySelectorAll("#carousel > div:not(:last-child)");
        let current = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.opacity = i === index ? '1' : '0';
                slide.classList.toggle('z-10', i === index);
                slide.classList.toggle('z-0', i !== index);
            });
        }

        document.getElementById("next").addEventListener("click", () => {
            current = (current + 1) % slides.length;
            showSlide(current);
        });

        document.getElementById("prev").addEventListener("click", () => {
            current = (current - 1 + slides.length) % slides.length;
            showSlide(current);
        });

        setInterval(() => {
            current = (current + 1) % slides.length;
            showSlide(current);
        }, 6000);

        showSlide(current);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\project coding\filament-imipas\filament-app\src\resources\views/home.blade.php ENDPATH**/ ?>