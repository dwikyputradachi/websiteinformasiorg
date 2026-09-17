<nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-[#14315C]">BUPA<span class="text-[#C89B3C]">Info</span></a>
                </div>
                <div class="hidden sm:ml-10 sm:flex sm:space-x-8 h-full">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ Request::routeIs('home') ? 'border-[#C89B3C] text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} text-sm font-medium transition-colors">
                        Beranda
                    </a>
                    <a href="{{ route('struktur') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ Request::routeIs('struktur') ? 'border-[#C89B3C] text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} text-sm font-medium transition-colors">
                        Struktur Organisasi
                    </a>
                    <a href="{{ route('kawasan') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ Request::routeIs('kawasan', 'aset.index') ? 'border-[#C89B3C] text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} text-sm font-medium transition-colors">
                        Kawasan/Aset
                    </a>
                    <a href="{{ route('tentang') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ Request::routeIs('tentang') ? 'border-[#C89B3C] text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} text-sm font-medium transition-colors">
                        Tentang Kami
                    </a>
                </div>
            </div>
            <!-- Sengaja kosong: tombol admin tidak ditampilkan di sisi pengunjung -->
            <div class="flex items-center"></div>
        </div>
    </div>
</nav>
