<?php

namespace Database\Seeders;

use App\Models\Aset;
use App\Models\AsetPengelola;
use App\Models\Bagian;
use App\Models\Fasilitas;
use App\Models\Jabatan;
use App\Models\KategoriAset;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BupaSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin BUPA',
            'email' => 'admin@bpbatam.go.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Jabatan berjenjang + priority
        $jDirektur = Jabatan::create(['nama_jabatan' => 'Direktur', 'priority' => 1]);
        $jWadir = Jabatan::create(['nama_jabatan' => 'Wakil Direktur', 'priority' => 2]);
        $jManager = Jabatan::create(['nama_jabatan' => 'Manager', 'priority' => 3]);
        $jAsmen = Jabatan::create(['nama_jabatan' => 'Asisten Manager', 'priority' => 4]);
        $jStaff = Jabatan::create(['nama_jabatan' => 'Staff', 'priority' => 5]);

        // Bagian (dipegang lintas jabatan)
        $bOperasional = Bagian::create(['nama_bagian' => 'Operasional']);
        $bKeuangan = Bagian::create(['nama_bagian' => 'Keuangan']);
        $bEvaluasi = Bagian::create(['nama_bagian' => 'Evaluasi']);
        $bProgram = Bagian::create(['nama_bagian' => 'Program']);

        // Direktur
        $direktur = Pegawai::create(['nama' => 'Bagas Prasetyo', 'kontak' => 'bagas.p@bpbatam.go.id', 'asal' => 'BUPA', 'jabatan_id' => $jDirektur->id]);

        // 2 Wakil Direktur, masing-masing pegang beberapa bagian
        $buWadir = Pegawai::create(['nama' => 'Siti Rahma', 'kontak' => 'siti.r@bpbatam.go.id', 'asal' => 'BUPA', 'jabatan_id' => $jWadir->id, 'atasan_id' => $direktur->id]);
        $buWadir->bagian()->attach([$bOperasional->id, $bKeuangan->id, $bEvaluasi->id]);

        $pakWadir = Pegawai::create(['nama' => 'Herman Yusuf', 'kontak' => 'herman.y@bpbatam.go.id', 'asal' => 'BUPA', 'jabatan_id' => $jWadir->id, 'atasan_id' => $direktur->id]);
        $pakWadir->bagian()->attach([$bProgram->id, $bEvaluasi->id]);

        // Manager di bawah Bu Wadir, tiap manager bisa pegang lebih dari satu bagian
        $pakA = Pegawai::create(['nama' => 'Andi Wijaya', 'kontak' => 'andi.w@bpbatam.go.id', 'asal' => 'BUPA', 'jabatan_id' => $jManager->id, 'atasan_id' => $buWadir->id]);
        $pakA->bagian()->attach([$bOperasional->id, $bKeuangan->id]);

        $pakToto = Pegawai::create(['nama' => 'Toto Sugiarto', 'kontak' => 'toto.s@bpbatam.go.id', 'asal' => 'BUPA', 'jabatan_id' => $jManager->id, 'atasan_id' => $buWadir->id]);
        $pakToto->bagian()->attach([$bEvaluasi->id]);

        // Asisten manager + staff di bawah Pak Toto
        $pakNando = Pegawai::create(['nama' => 'Nando Saputra', 'kontak' => 'nando.s@bpbatam.go.id', 'asal' => 'BUPA', 'jabatan_id' => $jAsmen->id, 'atasan_id' => $pakToto->id]);
        $pakNando->bagian()->attach([$bKeuangan->id, $bProgram->id]);

        $pakMarwan = Pegawai::create(['nama' => 'Marwan Hidayat', 'kontak' => 'marwan.h@bpbatam.go.id', 'asal' => 'BUPA', 'jabatan_id' => $jAsmen->id, 'atasan_id' => $pakA->id]);
        $pakMarwan->bagian()->attach([$bProgram->id]);

        Pegawai::create(['nama' => 'Dewi Lestari', 'kontak' => 'dewi.l@bpbatam.go.id', 'asal' => 'BUPA', 'jabatan_id' => $jStaff->id, 'atasan_id' => $pakNando->id]);
        Pegawai::create(['nama' => 'Rudi Hartono', 'kontak' => 'rudi.h@bpbatam.go.id', 'asal' => 'BUPA', 'jabatan_id' => $jStaff->id, 'atasan_id' => $pakA->id]);

        // Kategori aset
        $kWisata = KategoriAset::create(['nama_kategori' => 'Wisata']);
        KategoriAset::create(['nama_kategori' => 'Sport']);
        KategoriAset::create(['nama_kategori' => 'Agribisnis']);
        $kHunian = KategoriAset::create(['nama_kategori' => 'Hunian']);
        KategoriAset::create(['nama_kategori' => 'KPLI3']);

        // Aset kategori Wisata (Sekupang)
        $rusa = Aset::create([
            'nama' => 'Taman Rusa Sekupang', 'deskripsi' => 'Kawasan konservasi rusa terbuka untuk kunjungan publik',
            'alamat_lokasi' => 'Sekupang, Batam', 'status_operasional' => 'Aktif', 'kategori_id' => $kWisata->id,
            'link_bfast' => 'https://b-fast.bpbatam.go.id/service/wisata',
        ]);
        $kiosA = Aset::create(['nama' => 'Kios A', 'deskripsi' => 'Sewa tenda harian di area Taman Rusa', 'alamat_lokasi' => 'Sekupang, Batam', 'status_operasional' => 'Aktif', 'kategori_id' => $kWisata->id, 'parent_id' => $rusa->id, 'link_bfast' => 'https://b-fast.bpbatam.go.id/service/stands/33']);
        Aset::create(['nama' => 'Kios B', 'deskripsi' => 'Sewa tenda harian di area Taman Rusa', 'alamat_lokasi' => 'Sekupang, Batam', 'status_operasional' => 'Aktif', 'kategori_id' => $kWisata->id, 'parent_id' => $rusa->id, 'link_bfast' => 'https://b-fast.bpbatam.go.id/service/wisata']);

        Fasilitas::create(['nama' => 'Wortel Pakan Kelinci', 'deskripsi' => 'Paket wortel untuk memberi makan rusa', 'aset_id' => $rusa->id]);
        Fasilitas::create(['nama' => 'Gazebo', 'deskripsi' => 'Tempat istirahat pengunjung', 'aset_id' => $rusa->id]);

        // Aset kategori Hunian (Guest House - contoh multi-pengelola)
        $guestHouse = Aset::create([
            'nama' => 'Guest House Batam', 'deskripsi' => 'Penginapan dekat RSBP Batam',
            'alamat_lokasi' => 'Batam Center', 'status_operasional' => 'Aktif', 'kategori_id' => $kHunian->id,
        ]);

        AsetPengelola::create(['aset_id' => $guestHouse->id, 'pegawai_id' => $pakNando->id, 'bagian_id' => $bKeuangan->id, 'keterangan' => 'Menangani keuangan & pembukuan']);
        AsetPengelola::create(['aset_id' => $guestHouse->id, 'pegawai_id' => $pakMarwan->id, 'bagian_id' => $bProgram->id, 'keterangan' => 'Menangani program & promosi']);
        AsetPengelola::create(['aset_id' => $kiosA->id, 'pegawai_id' => $pakA->id, 'bagian_id' => $bOperasional->id, 'keterangan' => 'Pengawas operasional harian']);
    }
}
