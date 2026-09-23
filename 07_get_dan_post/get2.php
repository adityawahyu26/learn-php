<?php 

if (isset($_GET["nama"]) && isset($_GET["alamat"])) {
	$nama = htmlspecialchars($_GET["nama"]);
	$alamat = htmlspecialchars($_GET["alamat"]);
} else {
	header("Location: get1.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>get2</title>
</head>
<body>
	
	<h3>halo selamat datang, <?= $nama; ?></h3>
	<p>kamu berasal dari <?= $alamat ?> ya?</p>

</body>
</html>