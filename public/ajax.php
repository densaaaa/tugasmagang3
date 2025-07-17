<?php
include '../config.php';
include '../function/Fobat.php';
include '../function/Fkategori.php';
include '../function/validasi.php';

$obat = new Obat($db);
$kategori = new Kategori($db);
$v = new Validasi();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi = $_POST['aksi'];

    // Simpan obat
    if ($aksi === 'simpan') {
        $data = [
            'nama_obat' => $_POST['nama_obat'],
            'harga' => $_POST['harga'],
            'tanggal_kadaluwarsa' => $_POST['tanggal_kadaluwarsa'],
            'tahun_produksi' => $_POST['tahun_produksi'],
            'deskripsi' => $_POST['deskripsi'],
            'kode_obat' => $_POST['kode_obat'],
            'id_kategori' => $_POST['id_kategori']
        ];

        $cekKosong = $v->validasiKosong($data, ['nama_obat', 'harga', 'tanggal_kadaluwarsa', 'tahun_produksi', 'kode_obat', 'id_kategori']);
        if ($cekKosong !== true) {
            echo json_encode(['status' => 'error', 'message' => $cekKosong]);
            exit;
        }

        $cekValidasi = $v->validasiObat($data);
        if ($cekValidasi !== true) {
            echo json_encode(['status' => 'error', 'message' => $cekValidasi]);
            exit;
        }

        $simpan = $obat->simpan($data);
        echo json_encode(['status' => $simpan ? 'OK' : 'Gagal']);
        exit;
    }

    // Hapus obat
    if ($aksi === 'hapus') {
        $hapus = $obat->delete($_POST['id']);
        echo json_encode(['status' => $hapus ? 'OK' : 'Gagal']);
        exit;
    }

    // Mengambil data obat
    if ($aksi === 'getAll') {
        $data = $obat->getAll();
        echo json_encode(['data' => $data]);
        exit;
    }

    // Mengambil data kategori
    if ($aksi === 'getKategori') {
        $data = $kategori->tampil(); // pastikan tampil() mengembalikan array associative
        echo json_encode(['data' => $data]);
        exit;
    }

    // Hapus kategori
    if ($aksi === 'hapusKategori') {
        $hapus = $kategori->delete($_POST['id']);
        echo json_encode(['status' => $hapus ? 'OK' : 'Gagal']);
        exit;
    }

    // Simpan kategor ajax
    if ($aksi === 'simpanKategori') {
        $data = [
            'nama_kategori' => $_POST['nama_kategori'],
            'kode_kategori' => $_POST['kode_kategori'],
            'status' => $_POST['status']
        ];

        $cekKosong = $v->validasiKosong($data, ['nama_kategori', 'kode_kategori', 'status']);
        if ($cekKosong !== true) {
            echo json_encode(['status' => 'error', 'message' => $cekKosong]);
            exit;
        }

        $simpan = $kategori->simpan($data);
        echo json_encode(['status' => $simpan === 'OK' ? 'OK' : 'Gagal', 'message' => $simpan]);
        exit;
    }
}

echo json_encode(['status' => 'error', 'message' => 'Aksi tidak valid']);
exit;
?>
