<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		* {
			margin: 0;
			padding: 0;
		}

		.login-form {
			width : 100%;
			height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.login {
			text-align : center;
			background-color: cadetblue;
			padding: 10px;
			border-radius: 5px;
		}

		input {
			padding: 5px;
			margin: 5px 0;
			border-radius: 5px;
			border: none;
		}

		button {
			background-color: black;
			color: cadetblue;
			padding: 5px;
			margin: 5px 0;
			border: none;
			border-radius: 5px;
		}
	</style>
</head>
<body>
	<div class="login-form">
		<div class="login">
			<form action="login_post2.php" method="post">
				<h3>LOGIN</h3>
				<input type="text" name="username" placeholder="masukkan username" required><br>
				<input type="password" name="password" placeholder="masukkan password" required><br>
				<button type="submit" name="submit">Login</button>
			</form>
		</div>
	</div>
</body>
</html>
