<!DOCTYPE html>
<html>
<head>
	<title>admin</title>
	<link rel="stylesheet" href="login.css" type="text/css">
</head>
<body>

<h2>LOGIN ADMIN </h2>

<form action="proses_login.php" method="post">
  <div class="imgcontainer">
    <img src="img_avatar.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit">Masuk</button>
</form>

</body>
</html>
