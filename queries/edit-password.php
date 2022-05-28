<?php
if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
}

$id = $_SESSION['pengguna_id'];
$result = mysqli_query($conn, "SELECT * FROM pengguna WHERE id = $id");
$row = mysqli_fetch_assoc($result);

$password_saat_ini = $password_saat_ini_err = "";
$password 		   = $password_err 		 = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$password_saat_ini = escape($_POST['password_saat_ini']);
	$password 		   = escape($_POST['password']);

	if (empty($password_saat_ini)) {
		$password_saat_ini_err = "Password saat ini wajib diisi!";
	} elseif (!password_verify($password_saat_ini, $row['password'])) {
		$password_saat_ini_err = "Password saat ini salah!";
	}

	if (empty($password)) {
		$password_err = "Password wajib diisi!";
	} elseif (!preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password) || strlen($password) < 4) {
		$password_err = "Password harus lebih dari 4 karakter, mengandung huruf BESAR, huruf kecil dan angka";
	}

	if (empty($password_saat_ini_err) && empty($password_err)) {
		
		$password = password_hash($password, PASSWORD_DEFAULT);
		$query = "UPDATE pengguna SET password = '$password' WHERE id = $id";

		if (mysqli_query($conn, $query)) {

			flash('message', 'Password berhasil diupdate!');
			redirect('/edit-password.php');

		} else {
			die('Terjadi kesalahan: ' . mysqli_error($conn));
		}

	}

}