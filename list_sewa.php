
<div class="card col-sm-12">
  <div class="card-header">
    <h4>Mobil yang akan di pinjam</h4>
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th>ID Mobil</th>
          <th>Nomor Mobil</th>
          <th>Merk</th>
          <th>Tanggal Sewa</th>
          <th>Picture</th>
          <th>
            Option
          </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($_SESSION["session_sewa"] as $hasil):        ?>
        <tr>
          <td><?php echo $hasil["id_mobil"]; ?></td>
          <td><?php echo $hasil["nomor_mobil"]; ?></td>
          <td><?php echo $hasil["merk"]; ?></td>
          <td><?php echo $hasil["tgl_Sewa"]; ?></td>
          <td>
            <img src="img_mobil/<?php echo $hasil["image"]; ?>" width="100" class="img">
          </td>
          <td>
            <a href="db_sewa.php?hapus=true=<?php echo $hasil["id_mobil"]; ?>">
              <button type="button" class="btn btn-danger">Hapus</button>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <a href="db_sewa.php?checkout=true" onclick="return confirm('Apakah anda yakin dengan pesanan ini?')">
      <button type="button" class="btn btn-danger">
        Chekout
      </button>
    </a>
  </div>
</div>
