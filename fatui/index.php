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

$jumlahDataPerhalaman = 3;
$jumlahData = count(select("SELECT id FROM harbingers"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
$halamanAktif = (isset($_GET['halaman']))? $_GET['halaman']: 1;
$dataAwal = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

$harbingers = select("SELECT * FROM harbingers LIMIT $dataAwal, $jumlahDataPerhalaman");

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

		.arrow:hover {
			color: orange;
		}
	</style>
</head>
<body>
	<button id="insert"><a href="insert.php">Insert New Data</a></button><br>
	<form action="" method="post" style="margin-bottom: 10px">
		<input type="text" name="keyword" placeholder="masukkan pencarian disini" autofocus autocomplete="off">
		<button type="submit" name="search">Search</button>
	</form>
	<?php if ($halamanAktif > 1) : ?>
		<a href="?halaman=<?= $halamanAktif - 1; ?>" class="arrow">&laquo;</a>
	<?php endif; ?>
	<?php for ($i = 1; $i <= $jumlahHalaman; $i++) :?>
		<?php if ($i == $halamanAktif) : ?>
			<a href="?halaman=<?= $i; ?>" style="margin: 5px; font-weight: bold; color: orange;"><?= $i; ?></a>
		<?php else : ?>
			<a href="?halaman=<?= $i; ?>" style="margin: 5px;"><?= $i; ?></a>
		<?php endif; ?>
	<?php endfor; ?>
	<?php if ($halamanAktif < $jumlahHalaman) : ?>
		<a href="?halaman=<?= $halamanAktif + 1; ?>" class="arrow">&raquo;</a>
	<?php endif; ?>
	<table border="1" cellpadding="10" cellspacing="0" style="margin-bottom: 10px">
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
				<td><?= htmlspecialchars($hr["nama"]); ?></td>
				<td><?= htmlspecialchars($hr["gelar"]); ?></td>
				<td><?= htmlspecialchars($hr["vision"]); ?></td>
				<td><?= htmlspecialchars($hr["region"]); ?></td>
			</tr>
			<?php $i++; ?>
		<?php endforeach; ?>
	</table>
	<a href="logout.php" name="logout" class="logout">Logout</a>
</body>
</html>