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
	$image = upload();
	if (!$image) {
		return false;
	}

	$query = "INSERT INTO harbingers 
	VALUES ('','$nama', '$gelar', '$vision', '$region', '$image')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function upload() {
	$namaFile = $_POST['image']['name'];
	$ukuranFile = $_POST['image']['size'];
	$error = $_POST['image']['error'];
	$tmpName = $_POST['image']['error'];

	if ($error === 4) {
		echo 	"<script>
					alert('Tolong masukkan gambar!');
				</script>";
		return false;
	}

	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode(".", $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo 	"<script>
					alert('Format gambar yang anda masukkan salah!');
				</script>";
		return false;
	}

	if ($ukuranFile > 1000000) {
		echo 	"<script>
					alert('Ukuran gambar yang anda masukkan terlalu besar!');
				</script>";
		return false;
	}

	$newFileName = uniqid();
	$newFileName .= ".";
	$newFileName .= $ekstensiGambar;

	move_uploaded_file($tmpName, "image/".$newFileName);

	return $newFileName;
}

function delete($id) {
	global $conn;

	$query = "DELETE FROM harbingers WHERE id = $id";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function search($keyword) {
	global $conn;

	$query = "SELECT * FROM harbingers WHERE 
				nama LIKE '%$keyword%' OR
				gelar LIKE '%$keyword%' OR
				vision LIKE '%$keyword%' OR
				region LIKE '%$keyword%'";

	return select($query);

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