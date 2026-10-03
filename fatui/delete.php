<?php 

// cek apa user sudah login
session_start();
if (!isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}

require "function.php";

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