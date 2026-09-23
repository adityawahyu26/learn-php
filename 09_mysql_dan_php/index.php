<?php 

require "function.php";

$harbingers = select("SELECT * FROM harbingers");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		img {
			width: 100px;
		}
	</style>
</head>
<body>
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
				<td><a href="">update</a> | <a href="">delete</a></td>
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