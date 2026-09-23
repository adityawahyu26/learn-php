<?php 

$conn = mysqli_connect("localhost", "root", "", "fatui");

function select($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	};
	return $rows;
};

?>