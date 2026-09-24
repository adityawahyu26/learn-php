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

function insert($data) {
	global $conn;

	$nama = htmlspecialchars($data["nama"]);
	$gelar = htmlspecialchars($data["gelar"]);
	$vision = htmlspecialchars($data["vision"]);
	$region = htmlspecialchars($data["region"]);
	$image = htmlspecialchars($data["image"]);

	$query = "INSERT INTO harbingers 
	VALUES ('','$nama', '$gelar', '$vision', '$region', '$image')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function delete($id) {
	global $conn;

	$query = "DELETE FROM harbingers WHERE id = $id";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function update($data) {
	global $conn;

	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$gelar = htmlspecialchars($data["gelar"]);
	$vision = htmlspecialchars($data["vision"]);
	$region = htmlspecialchars($data["region"]);
	$image = htmlspecialchars($data["image"]);

	$query = "UPDATE harbingers SET 
				id = $id,
				nama = '$nama',
				gelar = '$gelar',
				vision = '$vision',
				region = '$region',
				image = '$image'
			WHERE id = $id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

?>