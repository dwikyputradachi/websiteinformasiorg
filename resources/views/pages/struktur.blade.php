@extends('layouts.app')
@section('title', 'Struktur Organisasi')

@section('content')
<div x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 800)" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">   
    <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#14315C] tracking-tight">Struktur Organisasi</h1>
            <p class="text-sm text-gray-500 mt-2">
                Visualisasi hierarki dan tata kelola di BUPA BP Batam.
            </p>
        </div>
       
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50/50 border border-blue-100 rounded-full shadow-sm">
            <svg class="w-4 h-4 text-[#C89B3C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-xs font-medium text-[#14315C]">
                Klik profil untuk melihat bagian, aset, dan bawahan
            </span>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 relative min-h-[400px]">
        <div x-show="loading" class="w-full flex flex-col items-center justify-center py-16">
            <div class="animate-pulse flex flex-col items-center">
                <div class="h-16 w-48 bg-gray-200 rounded-xl mb-4"></div>
                <div class="h-8 w-1 bg-gray-200 mb-4"></div>
                <div class="w-64 h-1 bg-gray-200 relative mb-4">
                    <div class="absolute -left-1 top-0 h-8 w-1 bg-gray-200"></div>
                    <div class="absolute -right-1 top-0 h-8 w-1 bg-gray-200"></div>
                </div>
                <div class="flex gap-8 mt-4">
                    <div class="h-16 w-32 bg-gray-200 rounded-xl"></div>
                    <div class="h-16 w-32 bg-gray-200 rounded-xl"></div>
                </div>
            </div>
        </div>

        <div x-cloak x-show="!loading" 
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="oc-scroll w-full overflow-x-auto rounded-b-2xl pb-4 [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-track]:bg-gray-50 [&::-webkit-scrollbar-thumb]:bg-gray-300 [&::-webkit-scrollbar-thumb]:rounded-full">

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