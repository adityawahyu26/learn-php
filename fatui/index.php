<?php 

require "function.php";

$harbingers = select("SELECT * FROM harbingers");

if (isset($_POST['search'])) {
	$harbingers = search($_POST['keyword']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		table {
			margin-top: 10px;
		}

		img {
			width: 100px;
		}

		#insert {
			margin: 10px;
			padding: 5px;
		}

		#insert a {
			text-decoration: none;
			color: black;
		}
	</style>
</head>
<body>
	<button id="insert"><a href="insert.php">Insert New Data</a></button><br>
	<form action="" method="post">
		<input type="text" name="keyword" placeholder="masukkan pencarian disini" autofocus autocomplete="none">
		<button type="submit" name="search">Search</button>
	</form>
	<table border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>No.</th>
			<th>Aksi</th>
			<th>Image</th>
			<th>Nama</th>
			<th>Gelar</th>
			<th>Vision</th>
			<th>Region</th>
		</tr>
		<?php $i = 1; ?>
		<?php foreach ($harbingers as $hr) : ?>
			<tr>
				<td><?= $i; ?></td>
				<td><a href="update.php?id=<?= $hr['id'] ?>">update</a> | 
					<a href="delete.php?id=<?= $hr['id'] ?>" onClick="return confirm('yakin ingin menghapus data?');">delete</a></td>
				<td><img src="image/<?= $hr["image"]; ?>" alt="harbingers"></td>
				<td><?= $hr["nama"]; ?></td>
				<td><?= $hr["gelar"]; ?></td>
				<td><?= $hr["vision"]; ?></td>
				<td><?= $hr["region"]; ?></td>
			</tr>
			<?php $i++; ?>
		<?php endforeach; ?>
	</table>
</body>
</html>