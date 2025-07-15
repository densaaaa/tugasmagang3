<?php
header('Content-Type: application/json');
include '../config.php';
include '../function/Fobat.php';
include '../function/validasi.php';

$obat = new Obat($db);
$v = new Validasi(); // ← tidak pakai argumen, karena kamu tidak punya constructor

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi = $_POST['aksi'];

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

    if ($aksi === 'hapus') {
        $hapus = $obat->delete($_POST['id']);
        echo json_encode(['status' => $hapus ? 'OK' : 'Gagal']);
        exit;
    }

    if ($aksi === 'getAll') {
        $data = $obat->getAll();
        echo json_encode(['data' => $data]);
        exit;
    }
}

echo json_encode(['status' => 'error', 'message' => 'Aksi tidak valid']);
exit;
?>
