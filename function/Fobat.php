<?php
class Obat {
    private $conn;

    function __construct($c) {
        $this->conn = $c;
    }

    function update($id, $d) {
        $stmt = $this->conn->prepare(
            "UPDATE obat SET nama_obat=?, harga=?, tanggal_kadaluwarsa=?, tahun_produksi=?, deskripsi=?, kode_obat=?, id_kategori=?
             WHERE id=?"
        );
        $stmt->bind_param("sdssssii", 
            $d['nama_obat'], $d['harga'], $d['tanggal_kadaluwarsa'], 
            $d['tahun_produksi'], $d['deskripsi'], $d['kode_obat'], $d['id_kategori'], $id
        );
        return $stmt->execute();
    }

    function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM obat WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    function getAll() {
        $query = "
            SELECT o.*, k.nama_kategori 
            FROM obat o 
            LEFT JOIN kategori_obat k ON o.id_kategori = k.id_kategori 
            ORDER BY o.id DESC
        ";

        $result = $this->conn->query($query);
        $rows = [];

        while ($row = $result->fetch_assoc()) {
            $row['harga'] = number_format($row['harga'], 0, ',', '.');
            $row['nama_kategori'] = $row['nama_kategori'] ?? '-';
            $row['aksi'] = "<button class='btn btn-danger btn-sm delete' data-id='{$row['id']}'>Hapus</button>";
            $rows[] = $row;
        }

        return $rows;
    }

    function generateKodeObat() {
        $query = $this->conn->query("SELECT kode_obat FROM obat ORDER BY id DESC LIMIT 1");
        $last = $query->fetch_assoc();
        $num = $last ? (int)substr($last['kode_obat'], 3) : 0;
        return "OBT" . str_pad($num + 1, 4, '0', STR_PAD_LEFT);
    }

    function simpan($d) {
    $stmt = $this->conn->prepare(
        "INSERT INTO obat (nama_obat, harga, tanggal_kadaluwarsa, tahun_produksi, deskripsi, kode_obat, id_kategori)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sdssssi", 
        $d['nama_obat'], $d['harga'], $d['tanggal_kadaluwarsa'], 
        $d['tahun_produksi'], $d['deskripsi'], $d['kode_obat'], $d['id_kategori']
    );
    return $stmt->execute();
}

}

?>
