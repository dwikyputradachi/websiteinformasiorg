@extends('layouts.admin')
@section('title', 'Admin · Kategori Aset')

@section('content')


<div class="form-box">
    <form method="POST" action="{{ route('admin.kategoris.store') }}">
        @csrf
        <div class="form-row">
            <div><label>Nama kategori</label><input name="nama_kategori" required placeholder="Wisata, Sport, Agribisnis, Hunian, KPLI3..."></div>
            <div><label>Deskripsi (opsional)</label><input name="deskripsi"></div>
        </div>
        <button class="btn-save" type="submit">+ Tambah kategori</button>
    </form>
</div>

<table class="admin-table">
    <thead><tr><th>Nama kategori</th><th>Jumlah aset</th><th></th></tr></thead>
    <tbody>
    @foreach ($kategoris as $k)
        <tr>
            <td>{{ $k->nama_kategori }}</td><td>{{ $k->aset_utama_count }}</td>
            <td>
                <form method="POST" action="{{ route('admin.kategoris.destroy', $k) }}" style="display:inline" onsubmit="return confirm('Hapus kategori ini?')">
                    @csrf @method('DELETE')<button class="btn-sm btn-danger" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
