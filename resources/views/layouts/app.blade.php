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

    @include('partials.navbar')

    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-100 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 pb-8 border-b border-gray-100/80">
                
                <div class="md:col-span-5 space-y-2.5">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-[#14315C] text-white flex items-center justify-center font-bold text-[11px]">
                            BP
                        </div>
                        <span class="font-bold text-[#14315C] text-sm tracking-tight">BUPA Info · BP Batam</span>
                    </div>
                    <p class="text-xs text-gray-500 leading-relaxed max-w-sm">
                        Direktori pusat data kawasan, fasilitas, struktur organisasi, dan profil pengelolaan aset di lingkungan Badan Usaha Pemanfaatan Aset BP Batam.
                    </p>
                </div>

                <div class="md:col-span-3 space-y-2.5">
                    <h4 class="text-xs font-bold text-gray-700 uppercase tracking-wider">Navigasi</h4>
                    <ul class="space-y-1.5 text-xs text-gray-500">
                        <li><a href="{{ route('kawasan') }}" class="hover:text-[#14315C] transition-colors">Daftar Kawasan & Aset</a></li>
                        <li><a href="{{ route('struktur') }}" class="hover:text-[#14315C] transition-colors">Struktur Organisasi</a></li>
                        <li><a href="{{ route('tentang') }}" class="hover:text-[#14315C] transition-colors">Tentang Kami</a></li>
                        <li><a href="https://b-fast.bpbatam.go.id" target="_blank" class="hover:text-[#14315C] transition-colors inline-flex items-center gap-1"><span>Portal B-Fast</span> &rarr;</a></li>
                    </ul>
                </div>

                <div class="md:col-span-4 space-y-2.5">
                    <h4 class="text-xs font-bold text-gray-700 uppercase tracking-wider">Kontak</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Gedung Badan Usaha Pemanfaatan Aset (BUPA), Kawasan Batam Center, Kota Batam, Kepulauan Riau
                    </p>
                    <div class="text-xs text-gray-600 font-medium">
                        Email: bupa@bpbatam.go.id
                    </div>
                </div>

            </div>

            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-gray-400">
                <p>&copy; {{ date('Y') }} Badan Usaha Pemanfaatan Aset (BUPA) - BP Batam.</p>
                <div class="text-[11px] text-gray-400">
                    Standar Informasi Internal & Publik
                </div>
            </div>
        </div>
    </footer>

</body>
</html>