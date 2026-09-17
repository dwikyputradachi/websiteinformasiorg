@php
    $colors = [
        ['bar' => '#14315C', 'bg' => '#EAF0FA', 'fg' => '#14315C'],
        ['bar' => '#C89B3C', 'bg' => '#FBF3E1', 'fg' => '#7A5D19'],
        ['bar' => '#2F6F62', 'bg' => '#E7F1EE', 'fg' => '#2F6F62'],
        ['bar' => '#8B3A50', 'bg' => '#F6E9EE', 'fg' => '#8B3A50'],
    ];
    $color = $colors[$colorIndex % count($colors)];
    $parts = collect(explode(' ', $pegawai->nama))->filter()->take(2);
    $initials = strtoupper($parts->map(fn ($w) => $w[0])->implode(''));
    $bawahan = $pegawai->bawahan;
@endphp
<li>
    <!-- class oc-card tetap dipertahankan, ditambahkan styling Tailwind & group untuk efek hover -->
    <a class="oc-card block relative w-48 bg-white border border-gray-100 rounded-xl shadow-sm p-4 hover:shadow-md hover:border-gray-300 transition-all duration-300 mx-auto group overflow-hidden" 
       href="{{ route('pegawai.show', $pegawai) }}" 
       style="color:inherit;">

        <!-- EFEK SHIMMER MENGKILAP (Muncul saat kartu di-hover) -->
        <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/60 to-transparent group-hover:translate-x-full transition-transform duration-700 ease-in-out z-10"></div>

        <!-- Garis Warna di Atas (Tetap pakai warna dinamis bawaanmu) -->
        <div class="absolute top-0 left-0 right-0 h-1.5" style="background:{{ $color['bar'] }}"></div>

        <!-- Konten Kartu (Z-index dinaikkan agar tidak tertutup shimmer) -->
        <div class="relative z-20">
            <div class="flex justify-between items-start mb-3 mt-1">
                
                <!-- Avatar (Tetap pakai foto atau inisial + warna dinamismu) -->
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm tracking-wide shadow-sm overflow-hidden" 
                     style="background:{{ $color['bg'] }};color:{{ $color['fg'] }}">
                    @if ($pegawai->foto)
                        <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="{{ $pegawai->nama }}" class="w-full h-full object-cover">
                    @else
                        {{ $initials }}
                    @endif
                </div>

                <!-- Indikator Bawahan Estetik (Hanya tampil jika > 0) -->
                @if ($bawahan->count() > 0)
                    <div class="flex items-center gap-1 text-[11px] font-semibold text-gray-500 bg-gray-50 px-2 py-1 rounded-md border border-gray-100" title="Memiliki {{ $bawahan->count() }} tim">
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span>{{ $bawahan->count() }}</span>
                    </div>
                @endif

            </div>

            <!-- Info Nama & Jabatan -->
            <div class="text-left">
                <div class="text-sm font-bold text-gray-800 truncate" title="{{ $pegawai->nama }}">
                    {{ $pegawai->nama }}
                </div>
                <div class="text-xs text-gray-500 truncate mt-0.5" title="{{ $pegawai->jabatan->nama_jabatan }}">
                    {{ $pegawai->jabatan->nama_jabatan }}
                </div>
            </div>
        </div>
    </a>

    <!-- Pemanggilan Anak/Bawahan Tetap Sama -->
    @if ($bawahan->count())
        <ul>
            @foreach ($bawahan as $i => $anak)
                @include('partials.pegawai-node', ['pegawai' => $anak, 'colorIndex' => $i + 1])
            @endforeach
        </ul>
    @endif
</li>