<?php
if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

$result = mysqli_query($conn, "SELECT * FROM kategori");

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$nama = escape($_POST['nama']);

	$cek_menu = mysqli_query($conn, "SELECT * FROM kategori WHERE nama = '$nama'");
	if (empty($nama)) {
		$errors[] = "Nama kategori wajib diisi!";
	} elseif (mysqli_num_rows($cek_menu) > 0) {
		$errors[] = "Nama kategori sudah diterdaftar";
	}

	if (empty($errors)) {

		if (mysqli_query($conn, "INSERT INTO kategori (nama) VALUES ('$nama')")) {

			flash('message', 'Data kategori berhasil ditambahkan!');
			redirect('/admin/kategori.php');

		} else {
			die('Terjadi kesalahan: ' . mysqli_error($conn));
		}

	}

}