@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')

<div class="bg-[#14315C] rounded-3xl p-8 sm:p-14 mb-14 shadow-lg relative overflow-hidden">
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 rounded-full bg-white opacity-5"></div>
    <div class="absolute bottom-0 left-10 -mb-24 w-56 h-56 rounded-full bg-white opacity-5"></div>
    <div class="relative z-10 max-w-2xl">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/10 text-[#C89B3C] mb-4 uppercase tracking-wider">Tentang Kami</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-4 tracking-tight">
            Badan Usaha Pemanfaatan Aset (BUPA)
        </h1>
        <p class="text-blue-100 text-sm sm:text-base leading-relaxed max-w-xl">
            Bagian dari Badan Pengusahaan Kawasan Perdagangan Bebas dan Pelabuhan Bebas Batam (BP Batam)
            yang bertanggung jawab mengelola dan mengembangkan kawasan serta aset milik BP Batam agar
            memberi manfaat optimal bagi masyarakat.
        </p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-14">
    <div class="lg:col-span-2">
        <h2 class="text-2xl font-bold text-[#14315C] mb-4">Kenapa website ini dibuat?</h2>
        <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed space-y-4">
            <p>
                BP Batam sudah memiliki B-Fast sebagai kanal layanan digital untuk transaksi penyewaan aset —
                mulai dari katalog layanan, harga, sampai proses pemesanan. B-Fast dirancang khusus untuk
                kebutuhan transaksional itu, dan sudah menjalankan perannya dengan baik.
            </p>
            <p>
                Yang belum tersedia adalah gambaran yang lebih menyeluruh: kawasan/aset apa saja yang
                dimiliki dan dikelola BUPA, di mana lokasinya, apa isinya, serta unit dan pegawai mana yang
                bertanggung jawab atas pengelolaannya. Informasi semacam ini sebelumnya tersebar dan sulit
                ditelusuri secara utuh — baik oleh tim internal BUPA sendiri maupun pihak luar yang
                membutuhkannya untuk koordinasi, audit, atau sekadar mencari tahu.
            </p>
            <p>
                Website ini dibangun sebagai <strong class="text-[#14315C]">pelengkap</strong>, bukan
                pengganti B-Fast — fokus kami murni pada penyajian informasi organisasi dan aset secara
                terstruktur dan saling terhubung. Setiap halaman aset di sini tetap menautkan pengunjung ke
                B-Fast begitu mereka butuh cek harga atau melakukan pemesanan.
            </p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-fit">
        <h3 class="font-bold text-[#14315C] mb-4">Sekilas Cakupan</h3>
        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-[#EAF0FA] text-[#14315C] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <div><div class="font-semibold text-gray-800 text-sm">~32 aset</div><div class="text-xs text-gray-500">di berbagai kawasan BP Batam</div></div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-[#FBF3E1] text-[#7A5D19] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                </div>
                <div><div class="font-semibold text-gray-800 text-sm">~12 kategori</div><div class="text-xs text-gray-500">Wisata, Sport, Agribisnis, Hunian, KPLI3, dan lainnya</div></div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-[#E7F1EE] text-[#2F6F62] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"></path></svg>
                </div>
                <div><div class="font-semibold text-gray-800 text-sm">Struktur berjenjang</div><div class="text-xs text-gray-500">Direktur → Wadir → Manager → Staff</div></div>
            </div>
        </div>
    </div>
</div>

<div class="mb-14">
    <h2 class="text-2xl font-bold text-[#14315C] mb-6 text-center">BUPA Info vs B-Fast</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="flex items-center gap-2 mb-3">
                <span class="w-2 h-2 rounded-full bg-[#0C447C]"></span>
                <h3 class="font-bold text-gray-800">B-Fast</h3>
            </div>
            <p class="text-sm text-gray-500 mb-4">Menjawab: <em>"Layanan apa yang tersedia dan berapa harganya?"</em></p>
            <ul class="text-sm text-gray-600 space-y-2">
                <li class="flex gap-2"><span class="text-[#0C447C]">✓</span> Katalog layanan &amp; harga sewa</li>
                <li class="flex gap-2"><span class="text-[#0C447C]">✓</span> Proses pemesanan &amp; pembayaran</li>
                <li class="flex gap-2"><span class="text-[#0C447C]">✓</span> Untuk masyarakat/penyewa</li>
            </ul>
        </div>
        <div class="bg-white rounded-2xl border border-[#C89B3C]/30 shadow-sm p-6 ring-1 ring-[#C89B3C]/10">
            <div class="flex items-center gap-2 mb-3">
                <span class="w-2 h-2 rounded-full bg-[#C89B3C]"></span>
                <h3 class="font-bold text-[#14315C]">BUPA Info (di sini)</h3>
            </div>
            <p class="text-sm text-gray-500 mb-4">Menjawab: <em>"Aset ini apa, di mana, dan dikelola siapa?"</em></p>
            <ul class="text-sm text-gray-600 space-y-2">
                <li class="flex gap-2"><span class="text-[#C89B3C]">✓</span> Profil kawasan, fasilitas &amp; lokasi</li>
                <li class="flex gap-2"><span class="text-[#C89B3C]">✓</span> Struktur organisasi &amp; unit pengelola</li>
                <li class="flex gap-2"><span class="text-[#C89B3C]">✓</span> Untuk publik, pegawai &amp; internal BUPA</li>
            </ul>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 sm:p-10 text-center">
    <h2 class="text-xl font-bold text-[#14315C] mb-2">Punya pertanyaan atau masukan?</h2>
    <p class="text-sm text-gray-500 max-w-md mx-auto mb-6">
        Kami masih terus melengkapi data kawasan dan struktur organisasi. Kalau ada informasi yang perlu
        diperbaiki, silakan hubungi tim BUPA BP Batam.
    </p>
    <a href="{{ route('struktur') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#14315C] text-white text-sm font-medium rounded-xl hover:bg-[#0c203d] transition-colors">
        Lihat Struktur Organisasi
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
    </a>
</div>

@endsection
