@extends('layouts.admin')
@section('title', 'Admin · Bagian')

@section('content')

<div class="form-box">
    <form method="POST" action="{{ route('admin.bagians.store') }}">
        @csrf
        <div class="form-row" style="grid-template-columns:1fr">
            <div><label>Nama bagian</label><input name="nama_bagian" required placeholder="Operasional, Keuangan, Evaluasi, Program..."></div>
        </div>
        <button class="btn-save" type="submit">+ Tambah bagian</button>
    </form>
</div>

<table class="admin-table">
    <thead><tr><th>Nama bagian</th><th>Dipegang oleh</th><th></th></tr></thead>
    <tbody>
    @foreach ($bagians as $b)
        <tr>
            <td>{{ $b->nama_bagian }}</td><td>{{ $b->pegawais_count }} pegawai</td>
            <td>
                <form method="POST" action="{{ route('admin.bagians.destroy', $b) }}" style="display:inline" onsubmit="return confirm('Hapus bagian ini?')">
                    @csrf @method('DELETE')<button class="btn-sm btn-danger" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
