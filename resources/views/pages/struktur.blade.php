@extends('layouts.app')
@section('title', 'Struktur Organisasi')

@section('content')
<div x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 500)" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">   
    
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/80 shadow-md shadow-gray-200/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-[11px] font-extrabold text-[#C89B3C] uppercase tracking-wider">Direktori Internal</span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#14315C] tracking-tight mt-0.5">Struktur Organisasi</h1>
            <p class="text-xs sm:text-sm text-gray-500 font-medium mt-1">
                Visualisasi hierarki, tata kelola, dan unit penanggung jawab di lingkungan BUPA BP Batam.
            </p>
        </div>
       
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-slate-50 border border-gray-200/80 rounded-2xl shadow-2xs">
            <svg class="w-4 h-4 text-[#C89B3C] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-xs font-semibold text-gray-600">
                Klik kartu untuk melihat profil & unit aset
            </span>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-md shadow-gray-200/50 border border-gray-200/80 relative min-h-[450px]">
        
        <div x-show="loading" class="w-full flex flex-col items-center justify-center py-20">
            <div class="animate-pulse flex flex-col items-center space-y-4">
                <div class="h-20 w-52 bg-gray-100 rounded-2xl border border-gray-200"></div>
                <div class="h-8 w-0.5 bg-gray-200"></div>
                <div class="w-72 h-0.5 bg-gray-200 relative"></div>
                <div class="flex gap-10 mt-2">
                    <div class="h-20 w-40 bg-gray-100 rounded-2xl border border-gray-200"></div>
                    <div class="h-20 w-40 bg-gray-100 rounded-2xl border border-gray-200"></div>
                </div>
            </div>
        </div>

        <div x-cloak x-show="!loading" 
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="oc-scroll w-full overflow-x-auto rounded-3xl pb-6 [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-track]:bg-gray-50 [&::-webkit-scrollbar-thumb]:bg-gray-300 [&::-webkit-scrollbar-thumb]:rounded-full">

            <div class="w-max min-w-full mx-auto p-10 lg:p-16">
                <ul class="orgchart inline-block">
                    @foreach ($roots as $i => $pegawai)
                        @include('partials.pegawai-node', ['pegawai' => $pegawai, 'colorIndex' => $i])
                    @endforeach
                </ul>
            </div>

        </div>

    </div>
</div>
@endsection