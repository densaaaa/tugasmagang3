<?php
include '../config.php';
include '../function/Fobat.php';

$obat = new Obat($db);
$kode_obat = $obat->generateKodeObat();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Obat Cihuy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" />
</head>

<body class="bg-dark text-white">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Apotek</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Data Obat</a></li>
                    <li class="nav-item"><a class="nav-link" href="form_kategori.php">Data Kategori</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Form Input Obat</h2>
        <form id="formObat">
            <div class="row mb-3">
                <div class="col">
                    <label>Nama Obat</label>
                    <input type="text" class="form-control" id="nama" required />
                </div>
                <div class="col">
                    <label>Harga</label>
                    <input type="number" class="form-control" id="harga" required />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Tanggal Kadaluwarsa</label>
                    <input type="date" class="form-control" id="tgl_kadaluarsa" required />
                </div>
                <div class="col">
                    <label>Tahun Produksi</label>
                    <input type="text" maxlength="4" class="form-control" id="thn_produksi" required />
                </div>
            </div>
            <div class="mb-3">
                <label>Kode Obat</label>
                <input type="text" class="form-control" id="kode_obat" required />
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <select class="form-control" id="id_kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php
                    $kategori = $db->query("SELECT * FROM kategori_obat WHERE status = 1");
                    while ($row = $kategori->fetch_assoc()) {
                        echo "<option value='{$row['id_kategori']}'>{$row['nama_kategori']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea class="form-control" id="deskripsi" rows="2"></textarea>
            </div>
            <button type="button" id="btnSimpan" class="btn btn-primary">Simpan</button>
        </form>

        <hr />
        <table id="tableObat" class="table table-dark table-striped mt-4">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Kadaluwarsa</th>
                    <th>Tahun</th>
                    <th>Deskripsi</th>
                    <th>Kode</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="../public/assets/main.js"></script>

</body>

</html>