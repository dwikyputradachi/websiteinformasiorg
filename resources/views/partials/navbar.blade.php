<nav x-data="{ showNav: false, mobileMenuOpen: false }" 
     x-init="setTimeout(() => showNav = true, 50)" 
     x-cloak
     x-show="showNav"
     x-transition:enter="transition ease-[cubic-bezier(0.25,1,0.5,1)] duration-700"
     x-transition:enter-start="-translate-y-full opacity-0"
     x-transition:enter-end="translate-y-0 opacity-100"
     class="bg-white/95 backdrop-blur-lg border-b border-gray-100 sticky top-0 z-50 shadow-sm">
     
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="flex items-center justify-between md:justify-center h-20">
            
            <div class="md:absolute md:left-4 sm:left-6 lg:left-8 flex items-center">
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
                <a href="{{ route('informasi.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ Request::routeIs('informasi.*') ? 'border-[#C89B3C] text-[#14315C] font-bold' : 'border-transparent text-gray-500 hover:text-[#14315C] hover:border-gray-200' }} text-sm transition-all duration-300">
                    Berita
                </a>

                
            </div>

            <div class="flex items-center md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-[#14315C] hover:bg-slate-50 focus:outline-none transition-colors">
                    <svg class="h-6 w-6 transition-transform duration-300" :class="{'rotate-90 scale-0': mobileMenuOpen, 'rotate-0 scale-100': !mobileMenuOpen }" stroke="currentColor" fill="none" viewBox="0 0 24 24" style="position: absolute;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6 transition-transform duration-300" :class="{'rotate-0 scale-100': mobileMenuOpen, '-rotate-90 scale-0': !mobileMenuOpen }" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
        </div>
    </div>

    <div x-show="mobileMenuOpen" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="-translate-y-4 opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="-translate-y-4 opacity-0"
         class="md:hidden bg-white border-b border-gray-100 absolute w-full shadow-xl">
        <div class="pt-2 pb-6 px-4 space-y-1">
            <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-sm {{ Request::routeIs('home') ? 'bg-blue-50 text-[#14315C] font-extrabold' : 'text-gray-600 font-medium hover:bg-slate-50 hover:text-[#14315C]' }} transition-colors">
                Beranda
            </a>
            <a href="{{ route('struktur') }}" class="block px-4 py-3 rounded-xl text-sm {{ Request::routeIs('struktur') ? 'bg-blue-50 text-[#14315C] font-extrabold' : 'text-gray-600 font-medium hover:bg-slate-50 hover:text-[#14315C]' }} transition-colors">
                Struktur Organisasi
            </a>
            <a href="{{ route('kawasan') }}" class="block px-4 py-3 rounded-xl text-sm {{ Request::routeIs('kawasan', 'aset.index', 'aset.show') ? 'bg-blue-50 text-[#14315C] font-extrabold' : 'text-gray-600 font-medium hover:bg-slate-50 hover:text-[#14315C]' }} transition-colors">
                Kawasan / Aset
            </a>
            <a href="{{ route('tentang') }}" class="block px-4 py-3 rounded-xl text-sm {{ Request::routeIs('tentang') ? 'bg-blue-50 text-[#14315C] font-extrabold' : 'text-gray-600 font-medium hover:bg-slate-50 hover:text-[#14315C]' }} transition-colors">
                Tentang Kami
            </a>
            <a href="{{ route('informasi.index') }}" class="block px-4 py-3 rounded-xl text-sm {{ Request::routeIs('informasi.*') ? 'bg-blue-50 text-[#14315C] font-extrabold' : 'text-gray-600 font-medium hover:bg-slate-50 hover:text-[#14315C]' }} transition-colors">
                Berita & Informasi
            </a>

        </div>
    </div>
</nav>