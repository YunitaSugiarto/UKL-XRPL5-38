<?php session_start(); ?>
<?php if (isset($_SESSION["session_karyawan"])): ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Menu</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- load jquery and bootstrap js -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-md bg-success navbar-dark sticky-top">
        <!-- navbar-expand-md -> Menu akan dihidden ketika tampilan device berukuran medium
        bg-danger -> navbar akan mempunyai background warna merah
        navbar-dark -> tulisan menu pada navbar akan lebih gelap
        fixed-top -> navbar akan berposisi selalu di atas -->
        <a href="#" class="text-white">
            <h3> RENTAL MOBIL | Admin </h3>
            <i class="fas fa-car"></i>
        </a>

<!-- pemanggilan icon menu saat menubar di sembunyikan -->
<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
    <span class="navbar navbar-toggler-icon"></span>
</button>

<!-- daftar menu pada navbar -->
    <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="kontak" data-toggle="dropdown">MENU</a>
                <div class="dropdown-menu">
                    <a href="template.php?page=karyawan" class="dropdown-item">Karyawan</a>
                    <a href="template.php?page=pelanggan" class="dropdown-item">Pengunjung</a>
                    <a href="template.php?page=mobil" class="dropdown-item">Data Mobil</a>
                    <a href="template.php?page=sewa" class="dropdown-item">Data Penyewaan</a>
                    <a href="proses_login.php?logout=true" class="dropdown-item">Logout</a>
                </div>
            </li>
        </ul>
    </div>
<h5 class="text-white">Selamat datang,<?php echo $_SESSION["session_karyawan"]["nama_karyawan"]; ?></h5>
</nav>
    <div class="container my-2 ">
      <?php if (isset($_GET["page"])): ?>
        <?php if ((@include $_GET["page"].".php") === true): ?>
          <?php include $_GET["page"].".php"; ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>
</body>

</html>
<?php else: ?>
    <?php echo "Anda Belum Login!"; ?>
    <br>
    <a href="index.php">
        SILAHKAN LOGIN DISINI!
    </a>
<?php endif; ?>