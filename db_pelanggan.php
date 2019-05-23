<?php
$koneksi = mysqli_connect("localhost","root","","rent_car");
if (isset($_POST["action"])){
    $id_pelanggan = $_POST["id_pelanggan"];
    $nama_pelanggan = $_POST["nama_pelanggan"];
    $alamat_ = $_POpelangganST["alamat_pelanggan"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $action = $_POST["action"];

    if ($action == "insert") {
        $path = pathinfo($_FILES["image"]["name"]);
        $extensi = $path["extension"];
        $filename = $nip."-".rand(1,1000).".".$extensi;    
        move_uploaded_file($_FILES["image"]["tmp_name"],"img_pelanggan/$filename");
        $sql = "insert into pelanggan values('$id_pelanggan','$nama_pelanggan','$alamat_pelanggan','$kontak','$username','$password')";
    

    }else if ($action == "update"){
        $sql = "select * from pelanggan where id_pelanggan='$id_pelanggan'";
        $result = mysqli_query($koneksi,$sql);
        $hasil = mysqli_fetch_array($result);
    
        if (isset($_FILES["image"])){
            if (file_exists("img_pelanggan/".$hasil["image"])) {
                unlink("img_pelanggan/".$hasil["image"]);
        }
        $path = pathinfo($_FILES["image"]["name"]);
        $extensi = $path["extension"];
        $filename = $nip."-".rand(1,1000).".".$extensi;

        //simpan file gambar
        move_uploaded_file($_FILES["image"]["tmp_name"],"img_pelanggan/$filename");
        // jika actionya "update"
        $sql = "update pelanggan set nama_pelanggan = '$nama_pelanggan',kontak='$kontak',username='$username',password='$password',image='$filename' where id_pelanggan='$id_pelanggan'";
        }else{
        $sql = "update pelanggan set nama_pelanggan = '$nama_pelanggan',kontak='$kontak',username='$username',password='$password',image='$filename' where id_pelanggan='$id_pelanggan'";
        }
    }
    //eksekusi sql-datanya
    mysqli_query($koneksi,$sql);
    echo $sql;
    header("location:templatepelanggan.php?page=pelanggan");
}
if (isset($_GET["hapus"])){
    $id_pelanggan = $_GET["id_pelanggan"];
    $sql = "select * from pelanggan where id_pelanggan='$id_pelanggan'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);
    if (file_exists("img_id_pelanggan/".$hasil["image"])) {
        unlink("img_id_pelanggan/".$hasil["image"]);
  }
  $id_pelanggan = $_GET["id_pelanggan"];
  $sql = "delete from pelanggan where id_pelanggan='$id_pelanggan'";
  mysqli_query($koneksi,$sql);
  header("location:templatepelanggan.php?page=pelanggan");
}
?>