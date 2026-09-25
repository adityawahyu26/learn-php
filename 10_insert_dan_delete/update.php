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
	<form action="" method="post">
		<input type="hidden" name="id" value="<?= $hr['id']; ?>">
		<input type="text" name="nama" required value="<?= $hr['nama']; ?>"><br>
		<input type="text" name="gelar" required value="<?= $hr['gelar']; ?>"><br>
		<input type="text" name="vision" required value="<?= $hr['vision']; ?>"><br>
		<input type="text" name="region" required value="<?= $hr['region']; ?>"><br>
		<input type="text" name="image" required value="<?= $hr['image']; ?>"><br>
		<button type="submit" name="submit" class="submit">Update</button>
	</form>
	<button id="back"><a href="index.php">Kembali</a></button>
</body>
</html>