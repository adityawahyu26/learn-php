<?php 

// $buah = ["apel", "jeruk", "semangka"];
// $buah[] = "melon";
// var_dump($buah);
// print_r($buah);
// echo $buah[2];

$mahasiswa = [ ["wanderer", "laki-laki", "inazuma", "filsafat"],
				["collei", "perempuan", "sumeru", "alam"],
				["layla", "perempuan", "sumeru", "antariksa"] ];

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php foreach ($mahasiswa as $mhs) : ?>
		<ul>
			<li>Nama : <?= $mhs[0]; ?></li>
			<li>Gender : <?= $mhs[1]; ?></li>
			<li>Asal : <?= $mhs[2]; ?></li>
			<li>Jurusan : <?= $mhs[3]; ?></li>
		</ul>
	<?php endforeach; ?>
</body>
</html>