@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8"
     x-data="{ loading: true }"
     x-init="setTimeout(() => loading = false, 500)">

    <!-- ========================================== -->
    <!-- SHIMMER / SKELETON LOADING                 -->
    <!-- ========================================== -->
    <div x-show="loading" class="space-y-10 animate-pulse">
        <div class="bg-gray-100 rounded-3xl h-64 border border-gray-200/80 shadow-md"></div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-gray-100 rounded-3xl h-80 border border-gray-200/80 shadow-md"></div>
            <div class="bg-gray-100 rounded-3xl h-64 border border-gray-200/80 shadow-md"></div>
        </div>
        <div class="bg-gray-100 rounded-3xl h-72 border border-gray-200/80 shadow-md"></div>
    </div>

    <!-- ========================================== -->
    <!-- KONTEN UTAMA                               -->
    <!-- ========================================== -->
    <div x-cloak x-show="!loading" 
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0">

        <!-- HEADER BANNER -->
        <div class="bg-[#14315C] rounded-3xl p-8 sm:p-14 mb-14 shadow-md shadow-gray-200/50 border border-blue-900/40 relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 rounded-full bg-white opacity-5"></div>
            <div class="absolute bottom-0 left-10 -mb-24 w-56 h-56 rounded-full bg-white opacity-5"></div>
            <div class="relative z-10 max-w-2xl">
                <span class="inline-flex items-center px-3.5 py-1 rounded-full text-xs font-extrabold bg-white/10 text-[#C89B3C] mb-4 uppercase tracking-wider border border-white/10">Tentang Kami</span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-4 tracking-tight">
                    Badan Usaha Pemanfaatan Aset (BUPA)
                </h1>
                <p class="text-blue-100 text-sm sm:text-base leading-relaxed max-w-xl font-medium">
                    Bagian dari Badan Pengusahaan Kawasan Perdagangan Bebas dan Pelabuhan Bebas Batam (BP Batam)
                    yang bertanggung jawab mengelola dan mengembangkan kawasan serta aset milik BP Batam agar
                    memberi manfaat optimal bagi masyarakat.
                </p>
            </div>
        </div>

        <!-- SEKSI KONTEN & CAKUPAN -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-14 items-start">
            <div class="lg:col-span-2 bg-white rounded-3xl p-8 border border-gray-200/80 shadow-md shadow-gray-200/50">
                <h2 class="text-2xl font-extrabold text-[#14315C] mb-4 tracking-tight">Kenapa website ini dibuat?</h2>
                <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed space-y-4 font-medium">
                    <p>
                        BP Batam sudah memiliki B-Fast sebagai kanal layanan digital untuk transaksi penyewaan aset,
                        mulai dari katalog layanan, harga, sampai proses pemesanan. B-Fast dirancang khusus untuk
                        kebutuhan transaksional itu, dan sudah menjalankan perannya dengan baik.
                    </p>
                    <p>
                        Yang belum tersedia adalah gambaran yang lebih menyeluruh: kawasan/aset apa saja yang
                        dimiliki dan dikelola BUPA, di mana lokasinya, apa isinya, serta unit dan pegawai mana yang
                        bertanggung jawab atas pengelolaannya. Informasi semacam ini sebelumnya tersebar dan sulit
                        ditelusuri secara utuh baik oleh tim internal BUPA sendiri maupun pihak luar yang
                        membutuhkannya untuk koordinasi, audit, atau sekadar mencari tahu.
                    </p>
                    <p>
                        Website ini dibangun sebagai <strong class="text-[#14315C] font-extrabold">pelengkap</strong>, bukan
                        pengganti B-Fast. Fokus kami murni pada penyajian informasi organisasi dan aset secara
                        terstruktur dan saling terhubung. Setiap halaman aset di sini tetap menautkan pengunjung ke
                        B-Fast begitu mereka butuh cek harga atau melakukan pemesanan.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-gray-200/80 shadow-md shadow-gray-200/50 p-6 h-fit">
                <h3 class="font-extrabold text-[#14315C] mb-4 text-base tracking-tight">Sekilas Cakupan</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-3.5 bg-slate-50/80 p-3.5 rounded-2xl border border-gray-200/60">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#14315C] flex items-center justify-center flex-shrink-0 border border-blue-100 font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <div><div class="font-extrabold text-[#14315C] text-sm">~32 aset</div><div class="text-xs font-medium text-gray-500">di berbagai kawasan BP Batam</div></div>
                    </div>
                    <div class="flex items-center gap-3.5 bg-slate-50/80 p-3.5 rounded-2xl border border-gray-200/60">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-[#C89B3C] flex items-center justify-center flex-shrink-0 border border-amber-100 font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                        </div>
                        <div><div class="font-extrabold text-[#14315C] text-sm">~12 kategori</div><div class="text-xs font-medium text-gray-500">Wisata, Sport, Agribisnis, Hunian, KPLI, dan lainnya</div></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PERBANDINGAN BUPA INFO VS B-FAST -->
        <div class="mb-14">
            <h2 class="text-2xl font-extrabold text-[#14315C] mb-6 text-center tracking-tight">BUPA Info vs B-Fast</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-3xl mx-auto">
                <div class="bg-white rounded-3xl border border-gray-200/80 shadow-md shadow-gray-200/50 p-7">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#0C447C]"></span>
                        <h3 class="font-extrabold text-[#14315C] text-base">B-Fast</h3>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500 font-medium mb-4">Menjawab: <em class="text-gray-700">"Layanan apa yang tersedia dan berapa harganya?"</em></p>
                    <ul class="text-xs sm:text-sm text-gray-600 font-medium space-y-2.5">
                        <li class="flex items-center gap-2.5"><span class="w-5 h-5 rounded-full bg-blue-50 text-[#0C447C] flex items-center justify-center text-xs font-bold border border-blue-100">✓</span> Katalog layanan &amp; harga sewa</li>
                        <li class="flex items-center gap-2.5"><span class="w-5 h-5 rounded-full bg-blue-50 text-[#0C447C] flex items-center justify-center text-xs font-bold border border-blue-100">✓</span> Proses pemesanan &amp; pembayaran</li>
                        <li class="flex items-center gap-2.5"><span class="w-5 h-5 rounded-full bg-blue-50 text-[#0C447C] flex items-center justify-center text-xs font-bold border border-blue-100">✓</span> Untuk masyarakat/penyewa</li>
                    </ul>
                </div>
                <div class="bg-white rounded-3xl border border-[#C89B3C]/40 shadow-md shadow-gray-200/50 p-7 ring-1 ring-[#C89B3C]/10">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#C89B3C]"></span>
                        <h3 class="font-extrabold text-[#14315C] text-base">BUPA Info</h3>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500 font-medium mb-4">Menjawab: <em class="text-gray-700">"Aset ini apa, di mana, dan dikelola siapa?"</em></p>
                    <ul class="text-xs sm:text-sm text-gray-600 font-medium space-y-2.5">
                        <li class="flex items-center gap-2.5"><span class="w-5 h-5 rounded-full bg-amber-50 text-[#C89B3C] flex items-center justify-center text-xs font-bold border border-amber-100">✓</span> Profil kawasan, fasilitas &amp; lokasi</li>
                        <li class="flex items-center gap-2.5"><span class="w-5 h-5 rounded-full bg-amber-50 text-[#C89B3C] flex items-center justify-center text-xs font-bold border border-amber-100">✓</span> Struktur organisasi &amp; unit pengelola</li>
                        <li class="flex items-center gap-2.5"><span class="w-5 h-5 rounded-full bg-amber-50 text-[#C89B3C] flex items-center justify-center text-xs font-bold border border-amber-100">✓</span> Untuk publik, pegawai &amp; internal BUPA</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- CALL TO ACTION -->
        <div class="bg-white rounded-3xl border border-gray-200/80 shadow-md shadow-gray-200/50 p-8 sm:p-10 text-center">
            <h2 class="text-xl font-extrabold text-[#14315C] mb-2 tracking-tight">Punya pertanyaan atau masukan?</h2>
            <p class="text-xs sm:text-sm text-gray-500 font-medium max-w-md mx-auto mb-6 leading-relaxed">
                Kami masih terus melengkapi data kawasan dan struktur organisasi. Kalau ada informasi yang perlu
                diperbaiki, silakan hubungi tim BUPA BP Batam.
            </p>
            <a href="{{ route('struktur') }}" class="inline-flex items-center gap-2.5 px-7 py-3.5 bg-[#14315C] text-white text-xs sm:text-sm font-extrabold uppercase tracking-wider rounded-2xl hover:bg-[#0c203d] transition-all shadow-md transform hover:-translate-y-0.5">
                <span>Lihat Struktur Organisasi</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

    </div>
</div>
@endsection