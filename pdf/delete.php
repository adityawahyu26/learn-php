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

$id = $_GET['id'];
if (delete($id) > 0) {
		echo '<script>
			alert("data berhasil dihapus!");
			window.location.replace("index.php"); 
			</script>';
} else {
		echo '<script>
			alert("data gagal dihapus!");
			window.location.replace("index.php"); 
			</script>';
		}

?>