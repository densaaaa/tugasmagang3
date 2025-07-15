<?php
class Validasi {
    // Validasi kolom kosong
    public function validasiKosong($data, $field){
        foreach ($field as $key) {
            if (empty(trim($data[$key]))) {
                return ucfirst($key) . " tidak boleh kosong";
            }
        }
        return true;
    }

    // Validasi OBAT
    public function validasiObat($data) {
        if (!preg_match("/^[a-zA-Z\s]+$/", $data['nama_obat'])) {
            return "Nama obat hanya boleh huruf dan spasi";
        }

        if (!is_numeric($data['harga'])) {
            return "Harga harus berupa angka";
        }

        if (!preg_match("/^\d{4}$/", $data['tahun_produksi'])) {
            return "Tahun produksi harus terdiri dari 4 digit angka";
        }

        if (!$this->isValidDate($data['tanggal_kadaluwarsa'])) {
            return "Tanggal kadaluwarsa tidak valid";
        }

        return true;
    }

    // Validasi KATEGORI
    public function validasiKategori($data) {
        if (!preg_match("/^[a-zA-Z\s]+$/", $data['nama_kategori'])) {
            return "Nama kategori hanya boleh huruf dan spasi";
        }

        if (!preg_match("/^[A-Z0-9\-]+$/", $data['kode_kategori'])) {
            return "Kode kategori hanya boleh huruf besar, angka, dan strip";
        }

        if (!in_array($data['status'], ['aktif', 'nonaktif'])) {
            return "Status kategori tidak valid";
        }

        return true;
    }

    private function isValidDate($date, $format = 'Y-m-d') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}
?>
