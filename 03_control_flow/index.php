<?php

// pengulangan
// for
// for ($i = 1; $i <= 5; $i++){
	// echo "ini adalah perulangan $i <br>";
// }

// while
// $i = 1;
// while ($i <= 10) {
	// echo "ini adalah perulangan ke ".$i."<br>";
	// $i++;
// }

// do.. while
// $i = 1;
// do {
	// echo "ini adalah perulangan ke ".$i."<br>";
	// $i++;
// } while ($i <= 10);

// ---
// pengkondisian 
// if.. else
// $suhu = 18;
// if ($suhu > 20) {
	// echo "suhu hangat mendekati panas";
// } else {
	// echo "suhu stabil dan mulai dingin";
// }

// if.. else if.. else
// $suhu = 12;
// if ($suhu >= 30) {
	// echo "suhu panas ekstrem mulai terdeteksi!";
// } else if ($suhu >= 20) {
	// echo "suhu terpantau stabil dan cerah";
// } else {
	// echo "suhu mulai turun dan mendingin";
// }

// ternary
// $suhu = 12;
// $winter = ($suhu > 10)? "cuaca tidak terlalu dingin dan menghangat" : "cuaca dingin ekstrem, tetap dirumah";
// echo $winter;

// switch
// $jawaban = "jakarta";
// switch ($jawaban) {
// 	case "surabaya":
// 	echo "salah, surabaya adalah ibukota provinsi jawa timur";
// 	break;
	
// 	case "jakarta":
// 	echo "benar, jakarta adalah ibukota indonesia";
// 	break;
	
// 	case "bandung":
// 	echo "salah, bandung adalah ibukota provinsi jawa barat";
// 	break;
	
// 	case "semarang":
// 	echo "salah, semarang adalah ibukota provinsi jawa tengah";
// 	break;
	
// 	default:
// 	echo "salah, jawaban anda masih kurang tepat";
// 	break;
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		.warna {
			background-color: cadetblue;
		}
	</style>
</head>
<body>
	<table border=1 cellpadding="10" cellspacing="0">
		<?php for ($i = 1; $i <= 10; $i++) : ?>
			<?php if ($i % 2 == 0) : ?>
			<tr class="warna">
			<?php else : ?>
			<tr>
			<?php endif; ?>
				<?php for ($j = 1; $j <= 10; $j++) : ?>
					<td><?= $i.".".$j; ?></td>
				<?php endfor; ?>
			</tr>
		<?php endfor; ?>
	</table>
</body>
</html>
