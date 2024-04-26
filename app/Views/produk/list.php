<?= $this->extend('template/layout') ?>
<?= $this->section('judul') ?>
 List Produk
<?= $this->endSection() ?>
<?= $this->section('konten') ?>
 <h3>Pencarian Produk : <?= $pencarian_id_produk==''?'Tidak ada pencarian':$pencarian_id_produk ?></h3>
 <hr/>
 <form>
 <label>Masukkan ID</label>
 <input type="text" name="cari">
 <input type="submit" value="Cari ID">
 </form>
 <table border="1">
 <tr>
 <th>No.</th>
 <th>ID</th>
 <th>Nama</th>
 <th>Stok</th>
 <th>Harga</th>
 <th>Deskripsi</th>
 <th>AKSI</th>
 </tr>
 <?php foreach ($data as $index => $row) {
 if ($row['id_produk'] == $pencarian_id_produk || $pencarian_id_produk == '') {
 $found++;
 $no = ($found>0)?$found:($index+1);
 ?>
 <tr>
 <td><?= $no ?></td>
 <td><?= $row['id_produk'] ?></td>
 <td><?= $row['nama_produk'] ?></td>
 <td><?= $row['stok_produk'] ?></td>
 <td><?= $row['harga_produk'] ?></td>
 <td><?= $row['deskripsi_produk'] ?></td>
 <td>
 <a href="<?='keranjang/proses?id_produk='.$row['id_produk'].'&nama_produk='.$row['nama_produk'].'&harga_
produk='.$row['harga_produk'] ?>">
 Tambahkan Ke Keranjang
 </a>
 </td>
 </tr>
 <?php
 }
 } ?>
 </table>
<?= $this->endSection() ?>