<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Apotek</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="index.html">Data Obat</a></li>
        <li class="nav-item"><a class="nav-link" href="form_kategori.html">Data Kategori</a></li>
      </ul>
    </div>
  </div>
</nav>

<h2>Input Kategori Obat</h2>
<form action="simpan_kategori.php" method="post">
  <input type="text" name="nama_kategori" placeholder="Nama Kategori" required><br>
  <input type="text" name="kode_kategori" placeholder="Kode Kategori" required><br>
  <select name="status">
    <option value="aktif">Aktif</option>
    <option value="nonaktif">Nonaktif</option>
  </select><br>
  <button type="submit">Simpan</button>
</form>


