<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel') · BUPA BP Batam</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 font-sans antialiased min-h-screen flex flex-col overflow-x-hidden selection:bg-[#C89B3C] selection:text-white" 
      x-data="{ loading: true }" 
      x-init="setTimeout(() => loading = false, 400)">

    <nav class="bg-[#14315C] border-b border-blue-900/50 fixed w-full top-0 z-50 h-16 shadow-md shadow-blue-900/10">
        <div class="w-full px-6 h-full flex justify-between items-center">
            
            <div class="flex items-center gap-3">
            
                <span class="text-lg font-bold text-white tracking-tight">
                    BUPA <span class="text-[#C89B3C]">Admin</span>
                </span>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('kawasan') }}" target="_blank" class="hidden sm:flex items-center gap-2 text-xs font-semibold text-blue-200 hover:text-white px-3.5 py-2 rounded-xl hover:bg-blue-900/50 transition-colors">
                    <span>Lihat Web Publik</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
                
                <div class="h-5 w-px bg-blue-900 hidden sm:block"></div>
                
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 text-xs font-semibold text-rose-200 hover:text-white bg-rose-950/60 hover:bg-rose-900 px-4 py-2 rounded-xl border border-rose-900/60 transition-all shadow-sm">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="pt-16 flex flex-grow relative w-full">
        
        <aside class="w-64 bg-white border-r border-gray-200/80 shadow-sm fixed top-16 bottom-0 left-0 z-40 flex flex-col flex-shrink-0">
            <nav class="flex-grow p-3 space-y-1.5 overflow-y-auto custom-scrollbar">
                
                <div class="px-4 py-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Manajemen Pegawai</div>
                <a class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.jabatans.*') ? 'bg-gradient-to-r from-[#14315C] to-blue-800 text-white shadow-md shadow-blue-900/25' : 'text-slate-600 hover:bg-slate-50 hover:text-[#14315C]' }}" href="{{ route('admin.jabatans.index') }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.jabatans.*') ? 'text-[#C89B3C]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Posisi Jabatan
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.pegawais.*') ? 'bg-gradient-to-r from-[#14315C] to-blue-800 text-white shadow-md shadow-blue-900/25' : 'text-slate-600 hover:bg-slate-50 hover:text-[#14315C]' }}" href="{{ route('admin.pegawais.index') }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.pegawais.*') ? 'text-[#C89B3C]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Daftar Pegawai
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.bagians.*') ? 'bg-gradient-to-r from-[#14315C] to-blue-800 text-white shadow-md shadow-blue-900/25' : 'text-slate-600 hover:bg-slate-50 hover:text-[#14315C]' }}" href="{{ route('admin.bagians.index') }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.bagians.*') ? 'text-[#C89B3C]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Unit Bagian
                </a>
                <div class="pt-3 pb-1 px-4">
                    <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Manajemen Kawasan</div>
                </div>
                <a class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.kategoris.*') ? 'bg-gradient-to-r from-[#14315C] to-blue-800 text-white shadow-md shadow-blue-900/25' : 'text-slate-600 hover:bg-slate-50 hover:text-[#14315C]' }}" href="{{ route('admin.kategoris.index') }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.kategoris.*') ? 'text-[#C89B3C]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Kategori Kawasan
                </a>                
                <a class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.asets.*') ? 'bg-gradient-to-r from-[#14315C] to-blue-800 text-white shadow-md shadow-blue-900/25' : 'text-slate-600 hover:bg-slate-50 hover:text-[#14315C]' }}" href="{{ route('admin.asets.index') }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.asets.*') ? 'text-[#C89B3C]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Data Aset
                </a>

                <a class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.fasilitas.*') ? 'bg-gradient-to-r from-[#14315C] to-blue-800 text-white shadow-md shadow-blue-900/25' : 'text-slate-600 hover:bg-slate-50 hover:text-[#14315C]' }}" href="{{ route('admin.fasilitas.index') }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.fasilitas.*') ? 'text-[#C89B3C]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    Fasilitas Pendukung
                </a>

                <a class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.pengelola.*') ? 'bg-gradient-to-r from-[#14315C] to-blue-800 text-white shadow-md shadow-blue-900/25' : 'text-slate-600 hover:bg-slate-50 hover:text-[#14315C]' }}" href="{{ route('admin.pengelola.index') }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.pengelola.*') ? 'text-[#C89B3C]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Tim Pengelola
                </a>

                <div class="pt-3 pb-1 px-4">
                    <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Manajemen Informasi</div>
                </div>
                <a class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.banners.*') ? 'bg-gradient-to-r from-[#14315C] to-blue-800 text-white shadow-md shadow-blue-900/25' : 'text-slate-600 hover:bg-slate-50 hover:text-[#14315C]' }}" href="{{ route('admin.banners.index') }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.banners.*') ? 'text-[#C89B3C]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Kelola Banner
                </a>
            </nav>
        </aside>

        <main class="flex-grow ml-64 w-[calc(100vw-16rem)] min-h-[calc(100vh-4rem)] relative">
            
            <div class="px-6 py-6 max-w-7xl mx-auto">
                
                @if (session('status'))
                    <div class="mb-6 px-5 py-4 rounded-2xl bg-emerald-50 border border-emerald-200 shadow-sm flex items-start gap-3 animate-fade-in-down">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <h4 class="text-xs font-bold text-emerald-800 uppercase tracking-wider">Berhasil</h4>
                            <p class="text-sm font-medium text-emerald-700 mt-0.5">{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                <!-- State Loading Skeleton -->
                <div x-show="loading" class="w-full space-y-6">
                    <div class="animate-pulse space-y-4">
                        <div class="h-32 bg-white rounded-3xl border border-gray-100 p-6 shadow-sm">
                            <div class="h-6 bg-gray-200 rounded-md w-1/4 mb-4"></div>
                            <div class="h-10 bg-gray-100 rounded-xl w-full"></div>
                        </div>
                        <div class="h-96 bg-white rounded-3xl border border-gray-100 p-6 shadow-sm flex flex-col gap-4">
                            <div class="h-8 bg-gray-200 rounded-md w-1/3 mb-4"></div>
                            <div class="h-12 bg-gray-100 rounded-xl w-full"></div>
                            <div class="h-12 bg-gray-100 rounded-xl w-full"></div>
                            <div class="h-12 bg-gray-100 rounded-xl w-full"></div>
                        </div>
                    </div>
                </div>

                <!-- Konten Asli -->
                <div x-cloak x-show="!loading" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    @yield('content')
                </div>

            </div>
        </main>
    </div>

    <!-- STYLE TAMBAHAN -->
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }
        .animate-fade-in-down {
            animation: fadeInDown 0.3s ease-out;
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>    
</body>
</html>