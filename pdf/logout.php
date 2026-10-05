<?php 

session_start();
session_unset();
$_SESSION = [];
session_destroy();
setcookie('remember_id', "", time() - 3600);
setcookie('remember_name', "", time() - 3600);
header("Location: login.php");
exit;

?>