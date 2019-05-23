<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","rent_car");
if (isset($_GET["sewa"])) {
  $id_mobil = $_GET["id_mobil"];
  $sql = "select * from mobil where id_mobil = '$id_mobil'";
  $result = mysqli_query($koneksi,$sql);
  $hasil = mysqli_fetch_array($result);

  if (!in_array($hasil,$_SESSION["session_sewa"])) {
    array_push($_SESSION["session_sewa"],$hasil);
  }
  header("location:templatepelanggan.php?page=list_mobil");
}

if (isset($_GET["checkout"])) {
  $id_sewa = rand(1,1000).date("dmY");
  $tgl = date("Y-m-d");
  $id_pelanggan = $_SESSION["session_pelanggan"]["id_pelanggan"];
  $sql = "insert into sewa values('$id_sewa','tgl_kembali','$id_pelanggan')";
  if (mysqli_query($koneksi,$sql)) {
    foreach ($_SESSION["session_sewa"] as $hasil) {
      $id_mobil = $hasil["id_mobil"];
        $jumlah = $_POST['jumlah_mobil'.$hasil["id_mobil"]];
        $total_bayar = $hasil["harga"];
        $sql = "insert into detail_sewa values('$id_sewa','$id_mobil','$jumlah','$total_bayar')";
        echo (mysqli_query($koneksi,$sql)) ? "" : mysqli_error($koneksi);
      }
      $_SESSION["session_sewa"] = array();
      header("location:templatepelanggan.php?page=nota&id_sewa=$id_sewa");
    }
  }
 ?>
