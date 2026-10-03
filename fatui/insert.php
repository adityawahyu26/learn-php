<?php 

require "function.php";

// cek apa user sudah login
session_start();

if (!isset($_SESSION['login']) && isset($_COOKIE['remember_id'], $_COOKIE['remember_name'])) {
	$result = select("SELECT * FROM board WHERE id = ?", "i", [$_COOKIE['remember_id']]);

	if (count($result) == 1) {
		$user = $result[0];

		if (hash_equals(hash('sha256', $user['username']), $_COOKIE['remember_name'] )) {

			session_regenerate_id();

			$_SESSION['login'] 		= true;
			$_SESSION['id'] 		= $user['id'];
			$_SESSION['username'] 	= $user['username'];
		}
	}
}

if (!isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Insert</title>
	<style>
		input {
			width: 25%;
			margin: 10px;
			padding: 5px;
		}

		.submit {
			margin: 10px;
			padding: 5px;
		}

		#back {
			margin: 10px;
			padding: 5px;
		}

		#back a {
			text-decoration: none;
			color: black;
		}
	</style>
</head>
<body>
	<?php 

	require "function.php";
	if (isset($_POST["submit"])) {
		if (insert($_POST) > 0) {
			echo '<script>
				alert("data berhasil dikirim!");
				window.location.replace("index.php"); 
				</script>';
		} else {
			echo '<script>
				alert("data gagal dikirim!");
				window.location.replace("index.php"); 
				</script>';
		}
	}

	?>
	<h1>Insert New Data</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="text" name="nama" placeholder="masukkan nama" required><br>
		<input type="text" name="gelar" placeholder="masukkan gelar" required><br>
		<input type="text" name="vision" placeholder="masukkan jenis vision" required><br>
		<input type="text" name="region" placeholder="masukkan region penempatan" required><br>
		<input type="file" name="image" placeholder="masukkan image anggota" required><br>
		<button type="submit" name="submit" class="submit">Insert</button>
	</form>
	<button id="back"><a href="index.php">Kembali</a></button>

</body>
</html>