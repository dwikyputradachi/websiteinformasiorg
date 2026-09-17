<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel') · BUPA BP Batam</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex flex-col overflow-x-hidden" x-data="{ sidebarOpen: true, loading: true }" x-init="setTimeout(() => loading = false, 600)">

    <nav class="bg-[#14315C] border-b border-blue-900 fixed w-full top-0 z-50 shadow-sm h-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <button @click="sidebarOpen = !sidebarOpen" class="text-blue-100 p-2 rounded-lg bg-blue-900/50 hover:bg-blue-800 hover:text-white focus:outline-none transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <span class="text-lg font-bold text-white tracking-wide">
                    BUPA <span class="text-[#C89B3C]">Admin</span>
                </span>
            </div>
            
            <div class="flex items-center space-x-4">
                <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-block text-xs font-medium text-blue-200 hover:text-white transition-colors">
                    Lihat Website &rarr;
                </a>
                <span class="text-xs text-blue-300 hidden sm:inline">|</span>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="text-xs font-medium text-rose-200 hover:text-white bg-rose-950/60 px-3 py-1.5 rounded-lg border border-rose-900 transition-colors">
                        Keluar
                    </button>
                </form>
            </div>

        </div>
    </nav>

    <div class="pt-16 flex-grow flex relative">
        
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false" 
             x-transition.opacity.duration.300ms
             class="fixed inset-0 bg-black/40 z-30 sm:hidden" style="display: none;"></div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed inset-y-0 left-0 pt-16 w-64 bg-[#14315C] text-white shadow-xl transform transition-transform duration-300 ease-out z-40 flex flex-col border-r border-blue-900">
            
            <div class="flex-grow p-4 space-y-1.5 overflow-y-auto">
                <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.pegawais.*') ? 'bg-[#C89B3C] text-white shadow-sm' : 'text-blue-100 hover:bg-blue-900/60' }}" href="{{ route('admin.pegawais.index') }}">
                    Pegawai
                </a>
                <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.jabatans.*') ? 'bg-[#C89B3C] text-white shadow-sm' : 'text-blue-100 hover:bg-blue-900/60' }}" href="{{ route('admin.jabatans.index') }}">
                    Jabatan
                </a>
                <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.bagians.*') ? 'bg-[#C89B3C] text-white shadow-sm' : 'text-blue-100 hover:bg-blue-900/60' }}" href="{{ route('admin.bagians.index') }}">
                    Bagian
                </a>
                <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.kategoris.*') ? 'bg-[#C89B3C] text-white shadow-sm' : 'text-blue-100 hover:bg-blue-900/60' }}" href="{{ route('admin.kategoris.index') }}">
                    Kategori Aset
                </a>
                <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.asets.*') ? 'bg-[#C89B3C] text-white shadow-sm' : 'text-blue-100 hover:bg-blue-900/60' }}" href="{{ route('admin.asets.index') }}">
                    Aset
                </a>
                <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.fasilitas.*') ? 'bg-[#C89B3C] text-white shadow-sm' : 'text-blue-100 hover:bg-blue-900/60' }}" href="{{ route('admin.fasilitas.index') }}">
                    Fasilitas
                </a>
                <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.pengelola.*') ? 'bg-[#C89B3C] text-white shadow-sm' : 'text-blue-100 hover:bg-blue-900/60' }}" href="{{ route('admin.pengelola.index') }}">
                    Pengelola Aset
                </a>
            </div>
        </aside>

        <main :class="sidebarOpen ? 'sm:translate-x-64' : 'translate-x-0'" 
              class="w-full transform transition-transform duration-300 ease-out max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            @if (session('status'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            <div x-show="loading" class="w-full space-y-6">
                <div class="animate-pulse space-y-4">
                    <div class="h-40 bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                        <div class="h-6 bg-gray-200 rounded-md w-1/4 mb-4"></div>
                        <div class="h-10 bg-gray-100 rounded-xl w-full"></div>
                    </div>
                    <div class="h-64 bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                        <div class="h-6 bg-gray-200 rounded-md w-1/3 mb-6"></div>
                        <div class="space-y-3">
                            <div class="h-12 bg-gray-100 rounded-xl w-full"></div>
                            <div class="h-12 bg-gray-100 rounded-xl w-full"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div x-cloak x-show="!loading" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0">
                @yield('content')
            </div>
            
        </main>
    </div>

</body>
</html>