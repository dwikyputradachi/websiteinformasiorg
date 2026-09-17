<div class="section-title" style="margin-top:0;display:flex;justify-content:space-between;align-items:center">
    Panel admin
    <form method="POST" action="{{ route('logout') }}"><button class="btn-sm" type="submit">@csrf Keluar</button></form>
</div>
<div class="admin-tabs">
    <a class="admin-tab {{ request()->routeIs('admin.pegawais.*') ? 'active' : '' }}" href="{{ route('admin.pegawais.index') }}">Pegawai</a>
    <a class="admin-tab {{ request()->routeIs('admin.jabatans.*') ? 'active' : '' }}" href="{{ route('admin.jabatans.index') }}">Jabatan</a>
    <a class="admin-tab {{ request()->routeIs('admin.bagians.*') ? 'active' : '' }}" href="{{ route('admin.bagians.index') }}">Bagian</a>
    <a class="admin-tab {{ request()->routeIs('admin.kategoris.*') ? 'active' : '' }}" href="{{ route('admin.kategoris.index') }}">Kategori Aset</a>
    <a class="admin-tab {{ request()->routeIs('admin.asets.*') ? 'active' : '' }}" href="{{ route('admin.asets.index') }}">Aset</a>
    <a class="admin-tab {{ request()->routeIs('admin.fasilitas.*') ? 'active' : '' }}" href="{{ route('admin.fasilitas.index') }}">Fasilitas</a>
    <a class="admin-tab {{ request()->routeIs('admin.pengelola.*') ? 'active' : '' }}" href="{{ route('admin.pengelola.index') }}">Pengelola Aset</a>
</div>
