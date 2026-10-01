<?php 

require 'function.php';

if (isset($_POST['submit'])) {
	if (regist($_POST) > 0) {
		echo "<script>
				alert('data berhasil ditambahkan');
				window.location.replace('login.php');
			</script>";
	} else {
		echo "<script>
				alert('data gagal ditambahkan');
			</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Regist Form</title>
	<style>
		* {
			margin: 0;
			padding: 0;
		}

		.container {
			width: 100%;
			height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
			background-color: whitesmoke;
		}

		.regist-form {
			width: 250px;
			display: flex;
			flex-direction: column;
			padding: 20px;
			background-color: cadetblue;
			color: white;
			box-sizing: border-box;
			border-radius: 10px;
		}

		form {
			display: flex;
			flex-direction: column;
		}

		h3 {
			text-align: center;
			font-weight: bold;
			margin-bottom: 10px;
			color: black;

		}

		label {
			margin-bottom: 5px;
		}

		input {
			margin-bottom: 20px;
			padding: 3px;
			border-radius: 3px;
			border: none;
		}

		button {
			background-color: black;
			border: none;
			color: cadetblue;
			padding: 8px;
			width: 100%;
			border-radius: 5px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="regist-form">
			<h3>REGIST FORM</h3>
			<form action="" method="post">
				<label for="username">Username :</label>
				<input type="text" name="username" id="username" required autocomplete="none" autofocus>
				<label for="password">Password :</label>
				<input type="password" name="password" id="password" required autocomplete="none">
				<label for="password2">Konfirmasi Password :</label>
				<input type="password" name="password2" id="password2" required autocomplete="none">
				<button type="submit" name="submit">Sign Up</button>
			</form>
		</div>
	</div>
</body>
</html>