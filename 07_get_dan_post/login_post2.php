<?php 

if (isset($_POST['submit'])) {
	$nama = htmlspecialchars($_POST['username']);
} else {
	header("Location: login_post1.php");
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>login post2</title>
</head>
<body>
	<h1>selamat datang, <?= $nama; ?></h1>
	<a href="login_post1.php">Logout</a>
</body>
</html>

