<?php 
session_start();
<div class="card col-sm-12">
  <div class="card-header">
    <h3>Nota Penyewaan</h3>
  </div>
  <div class="card-body">
    <?php
    $koneksi = mysqli_connect("localhost","root","","rent_car");
    $id_sewa = $_GET["id_sewa"];
    // data transaksi
    $sql = "select t.id_sewa, p.nama_pelanggan, t.tgl_sewa
    from sewa t inner join pelanggan p
    on t.id_pelanggan = p.id_pelanggan
    where t.id_sewa='$id_sewa'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);

    // data mobil
    $sql2 = "select b.*, dt.jumlah, dt.harga_sewa
    from mobil b inner join detail_sewa dt
    on b.id_mobil = dt.id_mobil
    where dt.id_sewa='$id_sewa'";
    $result2 = mysqli_query($koneksi,$sql2);
     ?>

     <h4>ID. Penyewaan : <?php echo $hasil["id_sewa"]; ?></h4>
     <h4>Nama Penyewa : <?php echo $hasil["nama_pelanggan"] ?></h4>
     <h4>Tgl Peminjaman: <?php echo $hasil["tgl_sewa"] ?></h4>

     <table class="table">
       <thead>
         <tr>
           <th>ID Mobil</th>
           <th>Nama Pelanggan</th>
           <th>Jumlah Penyewaan</th>
           <th>Harga</th>
           <th>Total</th>
         </tr>
       </thead>
       <tbody>
         <?php $total = 0; foreach ($result2 as $mobil): ?>
           <tr>
             <td><?php echo $mobil["id_mobil"]; ?></td>
             <td><?php echo $mobil["nama_pelanggan"] ?></td>
             <td><?php echo $mobil["jumlah"] ?></td>
             <td><?php echo "Rp".number_format($mobil["harga_sewa_per_hari"]); ?></td>
             <td><?php echo "Rp".number_format($mobil["harga_sewa_per_hari"]*$mobil["jumlah"]); ?></td>
           </tr>
         <?php
      $total += $mobil["harga_sewa"]*$mobil["jumlah"];
       endforeach; ?>
       </tbody>
     </table>
     <h2 class="text-right text-success">
      <?php echo "Rp ".number_format($total_bayar); ?>
     </h2>
  </div>
</div>
