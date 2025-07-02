<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My App')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Untuk Laravel + Vite --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Load Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">
    <nav class="bg-white shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex space-x-6">
                <a href="/" class="text-gray-700 hover:text-[#08243c] font-medium transition">Home</a>
                <a href="/pengumuman" class="text-gray-700 hover:text-[#08243c] font-medium transition">Pengumuman</a>
                <a href="/posisi" class="text-gray-700 hover:text-[#08243c] font-medium transition">Jabatan</a>
            </div>
            {{-- Kondisi Login --}}
            <div class="flex items-center space-x-4">
                @guest
                    <a href="/login"
                        class="inline-block px-5 py-2 bg-[#08243c] from-blue-500 to-blue-700 text-white font-semibold rounded-full shadow hover:from-blue-600 hover:to-blue-800 transition duration-200">
                        Login
                    </a>
                    <a href="/register"
                        class="inline-block px-5 py-2 bg-white text-[#08243c] border border-[#08243c] font-semibold rounded-full hover:bg-blue-50 transition duration-200">
                        Register
                    </a>
                @else
                    <div class="relative group inline-block">
                        <button
                            class="flex items-center justify-center w-10 h-10 rounded-full border border-[#08243c] bg-white text-[#08243c] hover:bg-[#f1f5f9] transition">
                            <!-- Heroicons User Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0" />
                            </svg>
                        </button>
                        <div
                            class="absolute right-0 mt-2 w-44 bg-white border rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-opacity z-50">
                            <a href="{{ route('profile') }}"
                                class="block px-4 py-2 text-[#08243c] hover:bg-gray-100">Dashboard</a>
                            <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left block px-4 py-2 text-[#08243c] hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

        </div>
    </nav>
    @if (View::hasSection('sidebar'))
        <div class="flex min-h-screen">
            <aside class="w-72 bg-white border-r shadow-md hidden md:block">
                @yield('sidebar')
            </aside>
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    @else
        <main class="w-full">
            @yield('content')
        </main>
    @endif

</body>

</html>
