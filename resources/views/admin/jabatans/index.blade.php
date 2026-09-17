@extends('layouts.admin')
@section('title', 'Admin · Jabatan')

@section('content')


<div class="form-box">
    <form method="POST" action="{{ route('admin.jabatans.store') }}">
        @csrf
        <div class="form-row">
            <div><label>Nama jabatan</label><input name="nama_jabatan" required></div>
            <div><label>Priority (1 = paling atas)</label><input type="number" name="priority" min="1" max="99" value="99" required></div>
        </div>
        <button class="btn-save" type="submit">+ Tambah jabatan</button>
    </form>
</div>

<table class="admin-table">
    <thead><tr><th>Nama jabatan</th><th>Priority</th><th></th></tr></thead>
    <tbody>
    @foreach ($jabatans as $j)
        <tr>
            <td>{{ $j->nama_jabatan }}</td><td>{{ $j->priority }}</td>
            <td>
                <form method="POST" action="{{ route('admin.jabatans.destroy', $j) }}" style="display:inline" onsubmit="return confirm('Hapus jabatan ini?')">
                    @csrf @method('DELETE')<button class="btn-sm btn-danger" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
