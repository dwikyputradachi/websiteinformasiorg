@extends('layouts.admin')
@section('title', 'Admin · Pengelola Aset')

@section('content')

<p class="pill" style="margin-top:-10px">
    Satu aset boleh punya lebih dari satu pengelola, masing-masing dalam bagian berbeda
    (contoh: Guest House dikelola Pak Nando di bagian Keuangan dan Pak Marwan di bagian Program sekaligus).
    Bagian yang dipilih harus sudah tercatat dipegang pegawai tersebut di menu Pegawai.
</p>

<div class="form-box">
    <form method="POST" action="{{ route('admin.pengelola.store') }}">
        @csrf
        <div class="form-row">
            <div><label>Aset</label>
                <select name="aset_id" required>
                    @foreach ($asets as $a)<option value="{{ $a->id }}">{{ $a->nama }}</option>@endforeach
                </select>
            </div>
            <div><label>Pegawai (pengelola)</label>
                <select name="pegawai_id" required>
                    @foreach ($pegawais as $p)<option value="{{ $p->id }}">{{ $p->nama }}{{ $p->asal === 'Eksternal' ? ' (Eksternal)' : '' }}</option>@endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div><label>Bagian/kapasitas (opsional, tapi harus sudah dipegang pegawai tsb)</label>
                <select name="bagian_id">
                    <option value="">- Tidak spesifik -</option>
                    @foreach ($bagians as $b)<option value="{{ $b->id }}">{{ $b->nama_bagian }}</option>@endforeach
                </select>
            </div>
            <div><label>Keterangan (opsional)</label><input name="keterangan" placeholder="mis. Menangani keuangan & pembukuan"></div>
        </div>
        <button class="btn-save" type="submit">+ Tambahkan pengelola</button>
    </form>
</div>

<table class="admin-table">
    <thead><tr><th>Aset</th><th>Pengelola</th><th>Bagian</th><th>Keterangan</th><th></th></tr></thead>
    <tbody>
    @foreach ($pengelola as $p)
        <tr>
            <td>{{ $p->aset->nama }}</td>
            <td>{{ $p->pegawai->nama }}{{ $p->pegawai->asal === 'Eksternal' ? ' (Eksternal)' : '' }}</td>
            <td>{{ $p->bagian->nama_bagian ?? '-' }}</td>
            <td>{{ $p->keterangan }}</td>
            <td>
                <form method="POST" action="{{ route('admin.pengelola.destroy', $p) }}" style="display:inline" onsubmit="return confirm('Lepas pengelola ini dari aset?')">
                    @csrf @method('DELETE')<button class="btn-sm btn-danger" type="submit">Lepas</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
