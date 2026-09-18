<nav class="bg-white/95 backdrop-blur-lg border-b border-gray-100 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="flex items-center justify-center h-20">
            
            <div class="absolute left-4 sm:left-6 lg:left-8 flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-extrabold tracking-tight text-[#14315C] flex items-center gap-1.5 hover:opacity-80 transition-opacity">
                    <span>BUPA</span><span class="text-[#C89B3C]">Info</span>
                </a>
            </div>
            
            <div class="hidden md:flex space-x-10 h-full">
                <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ Request::routeIs('home') ? 'border-[#C89B3C] text-[#14315C] font-bold' : 'border-transparent text-gray-500 hover:text-[#14315C] hover:border-gray-200' }} text-sm transition-all duration-300">
                    Beranda
                </a>
                <a href="{{ route('struktur') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ Request::routeIs('struktur') ? 'border-[#C89B3C] text-[#14315C] font-bold' : 'border-transparent text-gray-500 hover:text-[#14315C] hover:border-gray-200' }} text-sm transition-all duration-300">
                    Struktur Organisasi
                </a>
                <a href="{{ route('kawasan') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ Request::routeIs('kawasan', 'aset.index', 'aset.show') ? 'border-[#C89B3C] text-[#14315C] font-bold' : 'border-transparent text-gray-500 hover:text-[#14315C] hover:border-gray-200' }} text-sm transition-all duration-300">
                    Kawasan/Aset
                </a>
                <a href="{{ route('tentang') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ Request::routeIs('tentang') ? 'border-[#C89B3C] text-[#14315C] font-bold' : 'border-transparent text-gray-500 hover:text-[#14315C] hover:border-gray-200' }} text-sm transition-all duration-300">
                    Tentang Kami
                </a>
            </div>
            
        </div>
    </div>
</nav>