<?php
$koneksi = mysqli_connect("localhost","root","","rent_car");
if (isset($_POST["action"])){
    $id_karyawan = $_POST["id_karyawan"];
    $nama_karyawan = $_POST["nama_karyawan"];
    $alamat_karyawan = $_POST["alamat_karyawan"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $action = $_POST["action"];

    if ($action == "insert") {
        $path = pathinfo($_FILES["image"]["name"]);
        $extensi = $path["extension"];
        $filename = $nip."-".rand(1,1000).".".$extensi;    
        move_uploaded_file($_FILES["image"]["tmp_name"],"img_karyawan/$filename");
        $sql = "insert into karyawan values('$id_karyawan','$nama_karyawan','$alamat_karyawan','$kontak','$username','$password')";
    

    }else if ($action == "update"){
        $sql = "select * from karyawan where id_karyawan='$id_karyawan'";
        $result = mysqli_query($koneksi,$sql);
        $hasil = mysqli_fetch_array($result);
    
        if (isset($_FILES["image"])){
            if (file_exists("img_karyawan/".$hasil["image"])) {
                unlink("img_karyawan/".$hasil["image"]);
        }
        $path = pathinfo($_FILES["image"]["name"]);
        $extensi = $path["extension"];
        $filename = $nip."-".rand(1,1000).".".$extensi;

        //simpan file gambar
        move_uploaded_file($_FILES["image"]["tmp_name"],"img_karyawan/$filename");
        // jika actionya "update"
        $sql = "update karyawan set nama_karyawan = '$nama_karyawan',kontak='$kontak',username='$username',password='$password',image='$filename' where id_karyawan='$id_karyawan'";
        }else{
        $sql = "update karyawan set nama_karyawan = '$nama_karyawan',kontak='$kontak',username='$username',password='$password',image='$filename' where id_karyawan='$id_karyawan'";
        }
    }
    //eksekusi sql-datanya
    mysqli_query($koneksi,$sql);
    echo $sql;
    header("location:template.php?page=karyawan");
}
if (isset($_GET["hapus"])){
    $id_karyawan = $_GET["id_karyawan"];
    $sql = "select * from karyawan where id_karyawan='$id_karyawan'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);
    if (file_exists("img_id_karyawan/".$hasil["image"])) {
        unlink("img_id_karyawan/".$hasil["image"]);
  }
  $id_karyawan = $_GET["id_karyawan"];
  $sql = "delete from karyawan where id_karyawan='$id_karyawan'";
  mysqli_query($koneksi,$sql);
  header("location:template.php?page=karyawan");
}
?>