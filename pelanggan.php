<script type="text/javascript">
    function Add(){
    //set input action menjadi "insert"
        document.getElementById('action').value = "insert";

        //kosongkan inputan form-datanya
        document.getElementById("id_pelanggan").value = "";
        document.getElementById("nama_pelanggan").value = "";
        document.getElementById("kontak").value = "";
        document.getElementById("username").value = "";
    }
    function Edit(index){
        document.getElementById('action').value = "update";
        var table = document.getElementById("table_pelanggan");

        var id_pelanggan = table.rows[index].cells[0].innerHTML;
        var nama_pelanggan = table.rows[index].cells[1].innerHTML;
        var kontak = table.rows[index].cells[2].innerHTML;
        var username = table.rows[index].cells[3].innerHTML;

        document.getElementById("id_pelanggan").value = id_pelanggan;
        document.getElementById("nama_pelanggan").value = nama_pelanggan;
        document.getElementById("kontak").value = kontak;
        document.getElementById("username").value = username;
    }
    </script>
        <div class="card col-sm-12">
            <div class="card-header">
                <h4>Daftar Pelanggan</h4>
            </div>
            <div class="card-body">
                <?php
                $koneksi = mysqli_connect("localhost","root","","rent_car");
                $sql = "select * from pelanggan";
                $result = mysqli_query($koneksi,$sql);
                $count = mysqli_num_rows($result);
                ?>

                <?php if ($count == 0): ?>
                <div class="alert alert-info">
                Data Tidak Tersedia !
                </div>

                <?php else: ?>
                <table class="table" id="table_pelanggan">
                <thead>
                  <tr>
                    <th>id pelanggan</th>
                    <th>nama pelanggan</th>
                    <th>kontak</th>
                    <th>username</th>
                    <th>password</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($result as $hasil): ?>
                    <tr>
                      <td><?php echo $hasil["id_pelanggan"]; ?></td>
                      <td><?php echo $hasil["nama_pelanggan"]; ?></td>
                      <td><?php echo $hasil["kontak"]; ?></td>
                      <td><?php echo $hasil["username"]; ?></td>
                      <td><?php echo $hasil["password"]; ?></td>
                      <td>
                        <button type="button" class="btn btn-info" data-toggle="modal"
                          data-target="#modal" onclick="Edit(this.parentElement.parentElement.rowIndex);">
                            Edit 
                        </button>
                        <a href="db_pelanggan.php?hapus=pelanggan&id_pelanggan=<?php echo $hasil["id_pelanggan"];?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                        <button type="button" class="btn btn-danger">
                            Hapus
                        </button>
                        </a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
              </table>
            <?php endif; ?>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-success" data-toggle="modal"
              data-target="#modal" onclick="Add()">
                Tambah
              </button>
            </div>
        </div>
    </div>
    <!-- membuat modal/pop up -->
    <div class="modal fade" id="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="db_pelanggan.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h4>Form Pelanggan</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" id="action">
              <!-- untuk meyimpan aksi yang akan dilakukan entah itu insert/update -->
              id pelanggan
              <input type="text" name="id_pelanggan" id="id_pelanggan" class="form-control">
              nama 
              <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control">
              kontak
              <input type="text" name="kontak" id="kontak" class="form-control">
              username
              <input type="text" name="username" id="username" class="form-control">
              password
              <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
