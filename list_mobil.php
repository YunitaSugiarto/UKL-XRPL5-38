<?php
  $koneksi = mysqli_connect("localhost","root","","rent_car");
  $sql = "select * from mobil";
  $result = mysqli_query($koneksi,$sql);
?>
<div class="row">
  <?php foreach ($result as $hasil): ?>
    <div class="card col-sm-4">
      <div class="card-body">
        <img src="img_mobil/<?php echo $hasil["image"];?>" class="img" width="100%" height="100%">
      </div>
      <div class="card-footer">
        <b><h3 class="text-center"><?php echo $hasil["merk"]; ?></h3></b>
        <h6 class="text-center"><?php echo $hasil["jenis"]; ?></h6>
        <h6 class="text-center">Stok : <?php echo $hasil["stok"] ?></h6>
        <h6 class="text-center">Biaya Sewa per hari <?php echo $hasil["biaya_sewa_per_hari"]; ?></h6>

        <a href="db_sewa.php?sewa=true&id_mobil=<?php echo $hasil["id_mobil"]; ?>">
          <button type="button" class="btn btn-danger btn-block">
          SEWA
          </button>
        </a>
      </div>
    </div>
  <?php endforeach; ?>
</div>
