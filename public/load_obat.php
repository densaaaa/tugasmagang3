<?php
include '../config.php';

$sql = "SELECT o.*, k.nama_kategori 
        FROM obat o 
        LEFT JOIN kategori_obat k ON o.id_kategori = k.id_kategori";

$result = $db->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    if (!$row['nama_kategori']) {
        $row['nama_kategori'] = '-';
    }
    $data[] = $row;
}

echo json_encode(['data' => $data]);
