<?php

$conn = mysqli_connect("localhost", "root", "", "fatui");

if (!$conn) {
	die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

// folder tujuan upload gambar
const IMAGE_DIR = "image/";


// ---------------------------------------------------------------
// Helper: jalankan query dengan prepared statement
// $types  : string tipe param, contoh "ssi" (s = string, i = integer)
// $params : array nilai yang di-bind ke tanda tanya (?)
// return  : objek statement kalau berhasil, false kalau gagal
// ---------------------------------------------------------------
function run_query($query, $types = "", $params = []) {
	global $conn;

	$stmt = mysqli_prepare($conn, $query);
	if (!$stmt) {
		return false;
	}

	if ($types !== "") {
		mysqli_stmt_bind_param($stmt, $types, ...$params);
	}

	if (!mysqli_stmt_execute($stmt)) {
		return false;
	}

	return $stmt;
}


// ---------------------------------------------------------------
// SELECT: kembalikan array of rows
// Contoh: select("SELECT * FROM harbingers")
//         select("SELECT * FROM harbingers WHERE id = ?", "i", [$id])
// ---------------------------------------------------------------
function select($query, $types = "", $params = []) {
	$stmt = run_query($query, $types, $params);
	if (!$stmt) {
		return [];
	}

	$result = mysqli_stmt_get_result($stmt);
	if (!$result) {
		return [];
	}

	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}


// ---------------------------------------------------------------
// INSERT data harbinger
// Catatan: htmlspecialchars() TIDAK dipakai di sini. Pakai saat
// menampilkan data di halaman (echo htmlspecialchars($row['nama'])).
// ---------------------------------------------------------------
function insert($data) {
	$nama   = trim($data["nama"]);
	$gelar  = trim($data["gelar"]);
	$vision = trim($data["vision"]);
	$region = trim($data["region"]);

	$image = upload();
	if (!$image) {
		return false;
	}

	$stmt = run_query(
		"INSERT INTO harbingers (nama, gelar, vision, region, image) VALUES (?, ?, ?, ?, ?)",
		"sssss",
		[$nama, $gelar, $vision, $region, $image]
	);

	// kalau insert gagal, hapus gambar yang sudah terlanjur diupload
	if (!$stmt) {
		@unlink(IMAGE_DIR . $image);
		return false;
	}

	return mysqli_stmt_affected_rows($stmt);
}


// ---------------------------------------------------------------
// UPLOAD gambar dari $_FILES['image']
// return: nama file baru kalau berhasil, false kalau gagal
// ---------------------------------------------------------------
function upload() {
	if (!isset($_FILES['image'])) {
		echo "<script>alert('Tolong masukkan gambar!');</script>";
		return false;
	}

	$namaFile   = $_FILES['image']['name'];
	$ukuranFile = $_FILES['image']['size'];
	$error      = $_FILES['image']['error'];
	$tmpName    = $_FILES['image']['tmp_name'];

	if ($error === UPLOAD_ERR_NO_FILE) {
		echo "<script>alert('Tolong masukkan gambar!');</script>";
		return false;
	}

	if ($error !== UPLOAD_ERR_OK) {
		echo "<script>alert('Upload gambar gagal!');</script>";
		return false;
	}

	// cek ekstensi
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>alert('Format gambar yang anda masukkan salah!');</script>";
		return false;
	}

	// cek isi file benar-benar gambar (ekstensi bisa dipalsukan)
	if (getimagesize($tmpName) === false) {
		echo "<script>alert('File yang anda masukkan bukan gambar!');</script>";
		return false;
	}

	// cek ukuran (maks 1 MB)
	if ($ukuranFile > 1000000) {
		echo "<script>alert('Ukuran gambar yang anda masukkan terlalu besar!');</script>";
		return false;
	}

	$newFileName = uniqid() . "." . $ekstensiGambar;

	if (!move_uploaded_file($tmpName, IMAGE_DIR . $newFileName)) {
		echo "<script>alert('Gagal menyimpan gambar!');</script>";
		return false;
	}

	return $newFileName;
}


// ---------------------------------------------------------------
// DELETE data harbinger (sekaligus hapus file gambarnya)
// ---------------------------------------------------------------
function delete($id) {
	$id = (int) $id;

	$old = select("SELECT image FROM harbingers WHERE id = ?", "i", [$id]);

	$stmt = run_query("DELETE FROM harbingers WHERE id = ?", "i", [$id]);
	if (!$stmt) {
		return false;
	}

	$affected = mysqli_stmt_affected_rows($stmt);

	if ($affected > 0 && !empty($old[0]['image'])) {
		@unlink(IMAGE_DIR . basename($old[0]['image']));
	}

	return $affected;
}


// ---------------------------------------------------------------
// SEARCH berdasarkan nama / gelar / vision / region
// ---------------------------------------------------------------
function search($keyword) {
	$like = "%" . trim($keyword) . "%";

	return select(
		"SELECT * FROM harbingers WHERE
			nama LIKE ? OR
			gelar LIKE ? OR
			vision LIKE ? OR
			region LIKE ?",
		"ssss",
		[$like, $like, $like, $like]
	);
}


// ---------------------------------------------------------------
// UPDATE data harbinger
// return: 1 kalau berhasil (termasuk kalau tidak ada yang berubah),
//         false kalau gagal
// ---------------------------------------------------------------
function update($data) {
	$id     = (int) $data["id"];
	$nama   = trim($data["nama"]);
	$gelar  = trim($data["gelar"]);
	$vision = trim($data["vision"]);
	$region = trim($data["region"]);

	// ambil gambar lama dari database (bukan dari input form)
	$old = select("SELECT image FROM harbingers WHERE id = ?", "i", [$id]);
	if (empty($old)) {
		return false;
	}
	$oldImage = $old[0]['image'];

	$imageBaru = false;
	if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
		$imageBaru = upload();
		if (!$imageBaru) {
			return false;
		}
		$image = $imageBaru;
	} else {
		$image = $oldImage;
	}

	$stmt = run_query(
		"UPDATE harbingers SET nama = ?, gelar = ?, vision = ?, region = ?, image = ? WHERE id = ?",
		"sssssi",
		[$nama, $gelar, $vision, $region, $image, $id]
	);

	if (!$stmt) {
		// update gagal: buang gambar baru yang sudah terlanjur diupload
		if ($imageBaru) {
			@unlink(IMAGE_DIR . $imageBaru);
		}
		return false;
	}

	// update berhasil dan ada gambar baru: hapus gambar lama
	if ($imageBaru && !empty($oldImage)) {
		@unlink(IMAGE_DIR . basename($oldImage));
	}

	return 1;
}


// ---------------------------------------------------------------
// REGISTER user baru
// ---------------------------------------------------------------
function regist($data) {
	$username  = strtolower(trim($data['username']));
	$password  = $data['password'];
	$password2 = $data['password2'];

	if ($username === "" || $password === "") {
		return false;
	}

	// bandingkan password mentah SEBELUM di-hash
	if ($password !== $password2) {
		return false;
	}

	// cek username sudah dipakai atau belum
	$cek = select("SELECT id FROM board WHERE username = ?", "s", [$username]);
	if (count($cek) > 0) {
		return false;
	}

	// hash password lalu simpan
	$hash = password_hash($password, PASSWORD_DEFAULT);

	$stmt = run_query(
		"INSERT INTO board (username, password) VALUES (?, ?)",
		"ss",
		[$username, $hash]
	);

	if (!$stmt) {
		return false;
	}

	return mysqli_stmt_affected_rows($stmt);
}

?>