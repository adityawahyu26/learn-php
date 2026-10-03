<?php
session_start();
require 'function.php';

$error = "";

if (isset($_POST['submit'])) {

	$username = strtolower(trim($_POST['username']));
	$password = $_POST['password'];

	// ambil user dari database (hanya yang terdaftar via regist)
	$result = select("SELECT * FROM board WHERE username = ?", "s", [$username]);

	if (count($result) === 1) {
		$user = $result[0];

		// bandingkan password mentah dengan hash di database
		if (password_verify($password, $user['password'])) {

			// cegah session fixation
			session_regenerate_id(true);

			$_SESSION['login'] 		= true;
			$_SESSION['id'] 		= $user['id'];
			$_SESSION['username'] 	= $user['username'];

			header("Location: index.php");
			exit; 

		}
	}

	// pesan sengaja dibuat sama, supaya orang tidak bisa menebak
	// username mana yang terdaftar
	$error = "Username atau password salah.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Form</title>
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
			background-color: lightblue;
		}

		.regist-form {
			width: 250px;
			display: flex;
			flex-direction: column;
			padding: 20px;
			background-color: skyblue;
			color: darkblue;
			box-sizing: border-box;
			border-radius: 10px;
			box-shadow: 2px 2px 2px black;
		}

		form {
			display: flex;
			flex-direction: column;
		}

		h3 {
			text-align: center;
			font-weight: bold;
			margin-bottom: 10px;
			color: darkblue;

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

		a {
			display: block;
			text-align: center;
			margin-top: 10px;
			color: darkblue;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="regist-form">
			<h3>LOGIN</h3>
			<?php if ($error !== ""): ?>
				<p style="color: red; text-align: center; margin-bottom: 10px;">
					<?= htmlspecialchars($error) ?>
				</p>
			<?php endif; ?>
			<form action="" method="post">
				<label for="username">Username :</label>
				<input type="text" name="username" id="username" required autocomplete="off" autofocus>
				<label for="password">Password :</label>
				<input type="password" name="password" id="password" required autocomplete="off">
				<button type="submit" name="submit">Sign In</button>
				<a href="regist.php">Create Account</a>
			</form>
		</div>
	</div>
</body>
</html>