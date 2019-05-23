<!DOCTYPE html>
<html>
<head>
	<title>Login Pelanggan</title>
	<link rel="stylesheet" href="loginpelanggan.css" type="text/css">
</head>
<body>

<h2>LOGIN PELANGGAN </h2>

<form action="prosesloginpelanggan.php" method="post">
  <div class="imgcontainer">
    <img src="img_pelanggan.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit">Masuk</button>

  </div>
</form>

</body>
</html>
