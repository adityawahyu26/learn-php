<?php

// echo "hari ini tanggal : ".date("D, d-M-Y")."<br>";
// echo "100 hari yang lalu : ".date("d-M-Y", time()-(60*60*24*100))."<br>";
// echo "100 hari yang akan datang : ".date("d-M-Y", time()+(60*60*24*100))."<br>";
// echo "menggunakan mktime : ".date("D, d-M-Y", mktime(00,00,00,02,26,2005))."<br>";
// echo "menggunakan strtotime : ".date("D, d-M-Y", strtotime("december 16 2026"))."<br>";

function sapaan($waktu = "datang", $nama = "admin") {
	return "selamat $waktu, $nama";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?= sapaan("pagi","aditya"); ?>
</body>
</html>