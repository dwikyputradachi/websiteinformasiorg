<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Informasi BUPA') · BP Batam</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .oc-scroll { overflow-x: auto; padding: 10px 0 24px; }
        .orgchart, .orgchart ul { display: flex; justify-content: center; list-style: none; margin: 0; padding: 0; }
        .orgchart ul { padding-top: 28px; position: relative; }
        .orgchart li { display: flex; flex-direction: column; align-items: center; padding: 28px 14px 0 14px; position: relative; }
        .orgchart li::before, .orgchart li::after { content: ''; position: absolute; top: 0; right: 50%; border-top: 1px solid #ccc; width: 50%; height: 28px; }
        .orgchart li::after { right: auto; left: 50%; border-left: 1px solid #ccc; }
        .orgchart li:only-child::after, .orgchart li:only-child::before { display: none; }
        .orgchart li:only-child { padding-top: 0; }
        .orgchart li:first-child::before { border: 0 none; }
        .orgchart li:last-child::after { border: 0 none; }
        .orgchart li:last-child::before { border-right: 1px solid #ccc; border-radius: 0 6px 0 0; }
        .orgchart li:first-child::after { border-radius: 6px 0 0 0; }
        .orgchart ul::before { content: ''; position: absolute; top: 0; left: 50%; border-left: 1px solid #ccc; width: 0; height: 28px; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50/30 text-gray-800 font-sans antialiased min-h-screen flex flex-col">

    <!-- NAVBAR PUBLIK (Murni untuk Visitor/Pengguna) -->
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-2xl font-bold text-[#14315C]">BUPA<span class="text-[#C89B3C]">Info</span></span>
                    </div>
                    <!-- Menu Utama Pengunjung -->
                    <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-[#C89B3C] text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium transition-colors">
                            Beranda
                        </a>
                        <a href="{{ route('struktur') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('struktur', 'pegawai.show') ? 'border-[#C89B3C] text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium transition-colors">
                            Struktur Organisasi
                        </a>
                        <a href="{{ route('home') }}#kategori-aset" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('kategori*') || request()->routeIs('aset.*') ? 'border-[#C89B3C] text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium transition-colors">
                            Kawasan/Aset
                        </a>
                        <a href="#" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 text-sm font-medium transition-colors">
                            Tentang Kami
                        </a>
                    </div>
                </div>
                
                <!-- Sisi Kanan Kosong / Bersih dari Tombol Admin -->
                <div class="flex items-center">
                    <!-- Tidak ada tombol login/admin di sini agar visitor tidak tahu/tidak terganggu -->
                </div>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA PUBLIK -->
    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-100 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Badan Usaha Pemanfaatan Aset (BUPA) - BP Batam.
            </p>
        </div>
    </footer>

</body>
</html>