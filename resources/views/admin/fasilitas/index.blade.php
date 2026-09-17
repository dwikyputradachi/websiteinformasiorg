@extends('layouts.admin')
@section('title', 'Admin · Fasilitas')

@section('content')

<div class="form-box">
    <form method="POST" action="{{ route('admin.fasilitas.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div><label>Nama fasilitas</label><input name="nama" required placeholder="Pakan Kelinci, Gazebo, Tiket Masuk..."></div>
            <div><label>Aset induk</label>
                <select name="aset_id" required>
                    @foreach ($asets as $a)<option value="{{ $a->id }}">{{ $a->nama }}</option>@endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div><label>Deskripsi</label><textarea name="deskripsi" rows="2"></textarea></div>
            <div><label>Foto (opsional)</label><input type="file" name="foto" accept="image/*"></div>
        </div>
        <button class="btn-save" type="submit">+ Tambah fasilitas</button>
    </form>
</div>

<table class="admin-table">
    <thead><tr><th>Nama</th><th>Aset induk</th><th>Deskripsi</th><th></th></tr></thead>
    <tbody>
    @foreach ($fasilitas as $f)
        <tr>
            <td>{{ $f->nama }}</td>
            <td>{{ $f->aset->nama }}</td>
            <td>{{ $f->deskripsi }}</td>
            <td>
                <form method="POST" action="{{ route('admin.fasilitas.destroy', $f) }}" style="display:inline" onsubmit="return confirm('Hapus fasilitas ini?')">
                    @csrf @method('DELETE')<button class="btn-sm btn-danger" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
