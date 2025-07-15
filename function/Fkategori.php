<?php
class Kategori {
    private $conn;

    function __construct($c) {
        $this->conn = $c;
    }

    // ✅ Simpan kategori (dengan validasi duplikat kode & nama)
    function simpan($d) {
        // Validasi kode kategori tidak duplikat
        $cekKode = $this->conn->prepare("SELECT id_kategori FROM kategori_obat WHERE kode_kategori = ?");
        $cekKode->bind_param("s", $d['kode_kategori']);
        $cekKode->execute();
        $resKode = $cekKode->get_result();
        if ($resKode->num_rows > 0) {
            return "Kode kategori sudah digunakan!";
        }

        // Validasi nama kategori tidak duplikat
        $cekNama = $this->conn->prepare("SELECT id_kategori FROM kategori_obat WHERE nama_kategori = ?");
        $cekNama->bind_param("s", $d['nama_kategori']);
        $cekNama->execute();
        $resNama = $cekNama->get_result();
        if ($resNama->num_rows > 0) {
            return "Nama kategori sudah digunakan!";
        }

        // Simpan data
        $stmt = $this->conn->prepare(
            "INSERT INTO kategori_obat (nama_kategori, kode_kategori, status) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $d['nama_kategori'], $d['kode_kategori'], $d['status']);
        return $stmt->execute() ? "OK" : "Gagal simpan kategori";
    }

    // ✅ Ambil semua data kategori
    function getAll() {
        $q = $this->conn->query("SELECT * FROM kategori_obat ORDER BY id DESC");
        return $q->fetch_all(MYSQLI_ASSOC);
    }

    // ✅ Ambil hanya kategori dengan status aktif
    function getAktif() {
        $q = $this->conn->query("SELECT * FROM kategori_obat WHERE status = 'aktif' ORDER BY nama_kategori ASC");
        return $q->fetch_all(MYSQLI_ASSOC);
    }

    // ✅ Buat kode kategori otomatis, format: KAT-0001
    function buatKodeKategori() {
        $q = $this->conn->query("SELECT MAX(id) AS id_terakhir FROM kategori_obat");
        $r = $q->fetch_assoc();
        $next = isset($r['id_terakhir']) ? $r['id_terakhir'] + 1 : 1;
        return 'KAT-' . str_pad($next, 4, '0', STR_PAD_LEFT);
    }

    // ✅ Cari data berdasarkan ID (opsional kalau edit nanti)
    function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM kategori_obat WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }
}
?>
