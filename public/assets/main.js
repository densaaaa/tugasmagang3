$(document).ready(function () {
const t = $('#tableObat').DataTable({
    ajax: {
        url: 'ajax.php',
        type: 'POST',
        data: { aksi: 'getAll' }
    },
    columns: [
        { data: 'nama_obat' },
        { data: 'harga' },
        { data: 'tanggal_kadaluwarsa' },
        { data: 'tahun_produksi' },
        { data: 'deskripsi' },
        { data: 'kode_obat' },
        { data: 'nama_kategori' },
        { data: 'aksi' }
    ]
});


    // Simpan data obat
$('#btnSimpan').click(function () {
    const data = {
        aksi: 'simpan',
        nama_obat: $('#nama').val(),
        harga: $('#harga').val(),
        tanggal_kadaluwarsa: $('#tgl_kadaluarsa').val(),
        tahun_produksi: $('#thn_produksi').val(),
        deskripsi: $('#deskripsi').val(),
        kode_obat: $('#kode_obat').val(),
        id_kategori: $('#id_kategori').val()
    };

    $.post('ajax.php', data, function (res) {
        if (res.status === 'OK') {
            alert("Data berhasil disimpan!");
            $('#formObat')[0].reset();
            t.ajax.reload();
        } else {
            alert(res.message || "Gagal menyimpan data.");
        }
    }, 'json');
});


    // Hapus data
    $('#tableObat').on('click', '.delete', function () {
        const id = $(this).data('id');
        if (confirm('Yakin ingin menghapus?')) {
            $.post('ajax.php', { aksi: 'hapus', id: id }, function (res) {
                alert(res);
                t.ajax.reload();
            });
        }
    });
});
