<?php
	
$harbingers = [ [	"nama" => "arlecchino",
					"gelar" => "the knave",
					"vision" => "pyro",
					"region" => "fontaine"
				],
				[	"nama" => "sandrone",
					"gelar" => "marionette",
					"vision" => "cryo",
					"region" => "fontaine"
				],
				[	"nama" => "columbina",
					"gelar" => "damselette",
					"vision" => "hydro",
					"region" => "nodkrai"
				]
			];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Array Assosiatif</title>
</head>
<body>
	
	<?php foreach ($harbingers as $hr) : ?>
	<ul>
		<li>nama : <?= $hr["nama"] ?></li>
		<li>gelar : <?= $hr["gelar"] ?></li>
		<li>vision : <?= $hr["vision"] ?></li>
		<li>region : <?= $hr["region"] ?></li>
	</ul>
	<?php endforeach; ?>

</body>
</html>