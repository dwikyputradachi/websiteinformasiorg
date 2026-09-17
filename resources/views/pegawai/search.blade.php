@extends('layouts.app')
@section('title', 'Pencarian')

@section('content')
<div class="section-title" style="margin-top:0">Hasil pencarian "{{ $q }}"</div>
<div class="grid">
    @forelse ($pegawais as $p)
        <a class="card" href="{{ route('pegawai.show', $p) }}">
            <h3>{{ $p->nama }}</h3>
            <p>{{ $p->jabatan->nama_jabatan }}</p>
        </a>
    @empty
        <p class="pill">Tidak ada hasil</p>
    @endforelse
</div>
@endsection
