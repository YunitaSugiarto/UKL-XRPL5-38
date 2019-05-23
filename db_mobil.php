<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","rent_car");
if (isset($_POST["action"])){
    $id_mobil = $_POST["id_mobil"];
    $nomor_mobil = $_POST["nomor_mobil"];
    $merk = $_POST["merk"];
    $jenis = $_POST["jenis"];
    $stok = $_POST["stok"];
    $tahun_pembuatan = $_POST["tahun_pembuatan"];
    $biaya_sewa_per_hari = $_POST["biaya_sewa_per_hari"];
    $action = $_POST["action"];

    if ($action == "insert"){
        $path = pathinfo($_FILES["image"]["name"]);
        $extensi = $path["extension"];
        $filename = $id_mobil."-".rand(1,1000).".".$extensi;

        $sql = "insert into mobil values('$id_mobil','$nomor_mobil','$merk','$jenis','$stok','$tahun_pembuatan','$filename','$biaya_sewa_per_hari')";

        if (mysqli_query($koneksi,$sql)){
        //eksekusi berhasil
        move_uploaded_file($_FILES["image"]["tmp_name"],"img_mobil/$filename");
        $_SESSION["message"] = array(
          "type" => "succes",
          "message" => "insert data has been succes"
        );
    }else {
      //jika eksekusi gagal
      $_SESSION["message"] = array(
        "type" => "succes",
        "message" => mysqi_error($koneksi)
      );
    }
    header("location:template.php?page=mobil");
    
    
  }else if ($action == "update"){
        $sql = "select * from mobil where id_mobil='$id_mobil'";
        $result = mysqli_query($koneksi,$sql);
        $hasil = mysqli_fetch_array($result);

        if (isset($_FILES["image"])) {
            if (file_exists("img_mobil/".$hasil["image"])) {
              // jika file nya Tersedia
              unlink("img_mobil/".$hasil["image"]);
              //untuk menghapus file
            }
            $path = pathinfo($_FILES["image"]["name"]);
            $extensi = $path["extension"];
            $filename = $id_mobil."-".rand(1,1000).".".$extensi;
      
            move_uploaded_file($_FILES["image"]["tmp_name"],"img_mobil/$filename");
            $sql = "update mobil set nomor_mobil = '$nomor_mobil',merk='$merk',jenis='$jenis',stok='$stok',tahun_pembuatan='$tahun_pembuatan',biaya_sewa_per_hari='$biaya_Sewa_per_hari'image='$filename' where id_mobil='$id_mobil'";
          }else {
            $sql = "update mobil set nomor_mobil = '$nomor_mobil',merk='$merk',jenis='$jenis',stok='$stok',tahun_pembuatan='$tahun_pembuatan',biaya_sewa_per_hari='$biaya_Sewa_per_hari'image='$filename' where id_mobil='$id_mobil'";
          }
        }
        //eksekusi sql-datanya
        mysqli_query($koneksi,$sql);
        echo $sql;
        header("location:template.php?page=mobil");
      }
      
      if (isset($_GET["hapus"])) {
        // Jika yang dikirim adalah variable get Hapus
        $id_mobil = $_GET["id_mobil"];
        $sql = "select * from mobil where id_mobil='$id_mobil'";
        $result = mysqli_query($koneksi,$sql);
        $hasil = mysqli_fetch_array($result);
        if (file_exists("img_mobil/".$hasil["image"])) {
          unlink("img_mobil/".$hasil["image"]);
          //menghapus file
        }
        $sql = "delete from mobil where id_mobil='$id_mobil'";
        mysqli_query($koneksi,$sql);
        header("location:template.php?page=mobil");
      }
      ?>
      
    }
}