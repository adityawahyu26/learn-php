<?php 
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