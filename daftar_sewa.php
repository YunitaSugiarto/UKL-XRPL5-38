<div class="card col-sm-12">
  <div class="card-header">
    <h3>Daftar Sewa</h3>
  </div>
  <div class="card-body">
    <?php
    $koneksi = mysqli_connect("localhost","root","","rent_car");
    $sql = "select sewa.*,pelanggan.nama_pelanggan
    from sewa inner join pelanggan
    on sewa.id_pelanggan=pelanggan.id_pelanggan";
    $result = mysqli_query($koneksi,$sql);
     ?>

     <ul class="list-group">
       <?php foreach ($result as $hasil): ?>
         <li class="list-group-item">
           <h5>Penyewa: <?php echo $hasil["nama_pelanggan"]; ?>/<?php echo $hasil["id_sewa"]; ?></h5>
           <h5>Daftar Sewa:</h5>
           <?php
            $sql2 = "select mobil.*
            from detail_sewa inner join mobil
            on detail_sewa.id_mobil=mobil.id_mobil
            where detail_sewa.id_sewa='".$hasil["id_sewa"]."'";
            $result2 = mysqli_query($koneksi,$sql2);
            ?>
            <ul>
              <?php foreach ($result2 as $hasil2): ?>
                <li><?php echo $hasil2["id_mobil"]."/".$hasil2["merk"]; ?></li>
              <?php endforeach; ?>
            </ul>
            <?php if ($hasil["status"] == "0"): ?>
              <a href="db_sewa.php?kembali=true&id_sewa=<?php echo $hasil['id_sewa']; ?>">
                <button type="button" class="btn btn-info">Kembali</button>
              </a>
            <?php endif; ?>
         </li>
       <?php endforeach;?>
     </ul>
  </div>
</div>