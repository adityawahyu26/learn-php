<?php

require_once __DIR__ . '/vendor/autoload.php';
require "function.php";
$harbingers = select("SELECT * FROM harbingers");

$mpdf = new \Mpdf\Mpdf();

$i = 1;
$html = '<table border="1" cellpadding="10" cellspacing="0" style="margin-bottom: 10px">
		<tr style="background-color: cadetblue">
			<th>No.</th>
			<th>Image</th>
			<th>Nama</th>
			<th>Gelar</th>
			<th>Vision</th>
			<th>Region</th>
		</tr>';

foreach ($harbingers as $hr) {
	$html .= '<tr style="background-color: whitesmoke">
				<td>' . $i++ . '</td>
				<td><img src="image/'. $hr['image'] .'" alt="harbingers" style="width: 100px"></td>
				<td>' . htmlspecialchars($hr["nama"]) . '</td>
				<td>' . htmlspecialchars($hr["gelar"]) . '</td>
				<td>' . htmlspecialchars($hr["vision"]) . '</td>
				<td>' . htmlspecialchars($hr["region"]) . '</td>
			</tr>';
		}
$html .= '</table>';
$mpdf->WriteHTML($html);
$mpdf->Output();