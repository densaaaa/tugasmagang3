<?php
class Kategori {
    private $conn;

    function __construct($c) {
        $this->conn = $c;
    }
    function simpan($d) {
        // Validasi kode kategori duplikat
        $cekKode = $this->conn->prepare("SELECT id_kategori FROM kategori_obat WHERE kode_kategori = ?");
        $cekKode->bind_param("s", $d['kode_kategori']);
        $cekKode->execute();
        $resKode = $cekKode->get_result();
        if ($resKode->num_rows > 0) {
            return "Kode kategori sudah digunakan!";
        }

        // Validasi kategori duplikat
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
        $stmt->bind_param("ssi", $d['nama_kategori'], $d['kode_kategori'], $d['status']);
        return $stmt->execute() ? "OK" : "Gagal simpan kategori";
    }

    // Ambil semua kategori untuk DataTables
    function tampil() {
        $q = $this->conn->query("SELECT * FROM kategori_obat ORDER BY id_kategori DESC");
        $data = [];

        while ($row = $q->fetch_assoc()) {
            $row['status'] = $row['status'] ? 'Aktif' : 'Nonaktif';

            $row['aksi'] = '
                <button class="btn btn-sm btn-danger delete" data-id="'.$row['id_kategori'].'">Hapus</button>
            ';

            $data[] = $row;
        }

        return $data;
    }

    // Ambil kategori aktif untuk dropdown
    function getAktif() {
        $q = $this->conn->query("SELECT * FROM kategori_obat WHERE status = 1 ORDER BY nama_kategori ASC");
        return $q->fetch_all(MYSQLI_ASSOC);
    }

    // Ambil satu kategori berdasarkan ID
    function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM kategori_obat WHERE id_kategori = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    // Hapus kategori berdasarkan ID
    function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM kategori_obat WHERE id_kategori = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
