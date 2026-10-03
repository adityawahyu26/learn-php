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
	<title>Update</title>
	<style>
		input {
			width: 25%;
			margin: 10px;
			padding: 5px;
		}

		img {
			width: 100px;
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

	$id = $_GET['id'];

	if (isset($_POST["submit"])) {
		if (update($_POST) > 0) {
			echo '<script>
				alert("data berhasil diubah!");
				window.location.replace("index.php"); 
				</script>';
		} else {
			echo '<script>
				alert("data gagal diubah!");
				window.location.replace("index.php"); 
				</script>';
		}
	}

	$hr = select("SELECT * FROM harbingers WHERE id = $id")[0];

	?>
	<h1>Update Data</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="oldImage" value="<?= $hr['image']; ?>">
		<input type="hidden" name="id" value="<?= $hr['id']; ?>">
		<input type="text" name="nama" required value="<?= $hr['nama']; ?>"><br>
		<input type="text" name="gelar" required value="<?= $hr['gelar']; ?>"><br>
		<input type="text" name="vision" required value="<?= $hr['vision']; ?>"><br>
		<input type="text" name="region" required value="<?= $hr['region']; ?>"><br>
		<img src="image/<?= $hr['image']; ?>" alt="harbingers"><br>
		<input type="file" name="image" required><br>
		<button type="submit" name="submit" class="submit">Update</button>
	</form>
	<button id="back"><a href="index.php">Kembali</a></button>
</body>
</html>