<?php
include '../config.php';
include '../function/Fkategori.php';
include '../function/validasi.php';

$kategori = new Kategori($db);
$pesan = "";

// Proses simpan jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'nama_kategori' => $_POST['nama_kategori'],
        'kode_kategori' => $_POST['kode_kategori'],
        'status' => intval($_POST['status']) // convert ke integer
    ];

    $pesan = $kategori->simpan($data);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kategori Obat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffffff;
        }

        div.dataTables_filter {
            text-align: right !important;
        }

        div.dataTables_paginate {
            text-align: right !important;
            float: right !important;
        }

        div.dataTables_length {
            float: left !important;
        }

        div.dataTables_wrapper .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        div.dataTables_filter {
            float: right !important;
            text-align: right !important;
        }

        div.dataTables_wrapper .row:first-child {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>

    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Apotek</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Data Obat</a></li>
                    <li class="nav-item"><a class="nav-link active" href="form_kategori.php">Data Kategori</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="container mt-4">
        <h3 class="mb-3">Input Kategori Obat</h3>

        <?php if ($pesan): ?>
            <div class="alert <?= $pesan == "OK" ? 'alert-success' : 'alert-danger' ?>">
                <?= $pesan == "OK" ? "Kategori berhasil disimpan." : $pesan ?>
            </div>
        <?php endif; ?>

        <form method="post" class="mb-4">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="kode_kategori" class="form-label">Kode Kategori</label>
                    <input type="text" name="kode_kategori" id="kode_kategori" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="text-start">
                <button type="submit" class="btn btn-primary px-4 ">Simpan</button>
            </div>
        </form>
        <hr />
        <table id="tableKategori" class="table table table-striped mt-3">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Kode Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/main.js"></script>
</body>

</html>