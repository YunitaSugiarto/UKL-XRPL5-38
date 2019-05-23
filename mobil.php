<script type="text/javascript">
        function Add(){
          //set input action menjadi "insert"
          document.getElementById('action').value = "insert";

          //kosongkan inputan form-datanya
          document.getElementById("id_mobil").value = "";
          document.getElementById("nomor_mobil").value = "";
          document.getElementById("merk").value = "";
          document.getElementById("jenis").value = "";
          document.getElementById("stok").value = "";
          document.getElementById("tahun_pembuatan").value = "";
          document.getElementById("biaya_Sewa_per_hari").value = "";


        }
        function Edit(index){
          //set input action menjadi "update"
          document.getElementById('action').value = "update";

          //set form-nya berdasarkan data tabel yang dipilih
          var table = document.getElementById("table_mobil");
          //tampung data dari table_siswavar
          var id_mobil = table.rows[index].cells[0].innerHTML;
          var nomor_mobil = table.rows[index].cells[1].innerHTML;
          var merk = table.rows[index].cells[2].innerHTML;
          var jenis = table.rows[index].cells[3].innerHTML;
          var stok = table.rows[index].cells[5].innerHTML;
          var biaya_sewa_per_hari = table.rows[index].cells[6].innerHTML;


          //keluarkan pada Form
          document.getElementById("id_mobil").value = "id_mobil";
          document.getElementById("nomor_mobil").value = "nomor_mobil";
          document.getElementById("merk").value = "merk";
          document.getElementById("jenis").value = "jenis";
          document.getElementById("stok").value = "stok";
          document.getElementById("biaya_sewa_per_hari").value = "biaya_sewa_per_hari";
        }
      </script>
        <div class="card col-sm-12">
            <div class="card-header">
                <h4>Daftar Mobil</h4>
            </div>
            <div class="card-body">
            <?php
                //membuat koneksi ke database
                $koneksi = mysqli_connect("localhost","root","","rent_car");
                //localhost itu adalah sebagai hostname
                //root = username untuk akses database
                //"" = password untuk akses databases
                //crud = nama database-nya


                $sql = "select * from mobil";
                $result = mysqli_query($koneksi,$sql);
                //digunakan untuk eksekusi sintak sql
                $count = mysqli_num_rows($result);
                //digunakan untuk menampilkan jumlah data
            ?>

            <?php if ($count == 0): ?>
              <!-- jika data dari database kosong, maka akaan muncul pesan informasi -->
              <div class="alert alert-info">
                Data Tidak Tersedia
              </div>
            <?php else: ?>
              <!-- jika datanya ada maka akan di tampilan pada tabel -->
              <table class="table" id="table_mobil">
                <thead>
                  <tr>
                    <th>id mobil</th>
                    <th>nomor mobil</th>
                    <th>merk</th>
                    <th>jenis</th>
                    <th>stok</th>
                    <th>tahun pembuatan</th>
                    <th>Image</th>
                    <th>biaya sewa</th>                    
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($result as $hasil): ?>
                    <tr>
                      <td><?php echo $hasil["id_mobil"]; ?></td>
                      <td><?php echo $hasil["nomor_mobil"]; ?></td>
                      <td><?php echo $hasil["merk"]; ?></td>
                      <td><?php echo $hasil["jenis"]; ?></td>
                      <td><?php echo $hasil["stok"]; ?></td>
                      <td><?php echo $hasil["tahun_pembuatan"]; ?></td>
                      <td>
                        <img src="<?php echo "img_mobil/".$hasil["image"];?>"
                        class="img" width="100">
                      </td>
                      <td><?php echo $hasil["biaya_sewa_per_hari"]; ?></td>
                      <td>
                        <button type="button" class="btn btn-info" data-toggle="modal"
                        data-target="#modal" onclick="Edit(this.parentElement.parentElement.rowIndex);">
                          Edit
                        </button>
                        <a href="db_mobil.php?hapus=mobil&id_mobil=<?php echo $hasil["id_mobil"];?>" onclick="return confirm('Apakan anda yakin ingin menghapus data ini?')">
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
          <form action="db_mobil.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h4>Form Mobil</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" id="action">
              <!-- untuk meyimpan aksi yang akan dilakukan entah itu insert/update -->
        
              id mobil
              <input type="text" name="id_mobil" id="id_mobil" class="form-control">
              nomor mobil
              <input type="text" name="nomor_mobil" id="nomor_mobil" class="form-control">
              merk
              <input type="text" name="merk" id="merk" class="form-control">
              jenis
              <input type="text" name="jenis" id="jenis" class="form-control">
              stok
              <input type="number" name="stok" id="stok" class="form-control">
              tahun pembuatan
              <input type="text" name="tahun_pembuatan" id="tahun_pembuatan" class="form-control">
              biaya sewa
              <input type="text" name="biaya_sewa_per_hari" id="biaya_sewa_per_hari" class="form-control">
              image
              <input type="file" name="image" id="image" class="form-control">
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
