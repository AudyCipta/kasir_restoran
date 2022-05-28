<?php 
if (isset($_SESSION['pengguna_id'])) {
	if ($_SESSION['pengguna_level'] != 3) {
		redirect('admin');
	} else {
		redirect();
	}
}

$nama 	  = $nama_err 	  = "";
$email    = $email_err 	  = "";
$password = $password_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$nama 	  = escape($_POST['nama']);
	$email 	  = escape($_POST['email']);
	$password = escape($_POST['password']);

	if (empty($nama)) {
		$nama_err = "Nama wajib diisi!";
	} elseif (!preg_match("/^[a-zA-Z-' ]*$/", $nama)) {
		$nama_err = "Nama hanya boleh mengandung huruf dan spasi!";
	}

	$cek_pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE email = '$email'");
	if (empty($email)) {
		$email_err = "Email wajib diisi!";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$email_err = "Email format salah!";
	} elseif (mysqli_num_rows($cek_pengguna) > 0) {
		$email_err = "Email: $email sudah digunakan!";
	}

	if (empty($password)) {
		$password_err = "Password wajib diisi!";
	} elseif (!preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password) || strlen($password) < 6) {
		$password_err = "Kata sandi minimal 6 karakter dan mengandung huruf besar dan angka";
	}

	if (empty($nama_err) && empty($email_err) && empty($password_err)) {
		
		$password = password_hash($password, PASSWORD_DEFAULT);
		$query = "INSERT INTO pengguna (nama, email, password) VALUES ('$nama', '$email', '$password')";
		
		if (mysqli_query($conn, $query)) {
			
			$result = mysqli_query($conn, "SELECT * FROM pengguna WHERE email = '$email'");
			$row = mysqli_fetch_assoc($result);
			
			$_SESSION['pengguna_id'] 	= $row['id'];
			$_SESSION['pengguna_nama'] 	= $row['nama'];
			$_SESSION['pengguna_foto'] 	= $row['foto'];
			$_SESSION['pengguna_level'] = $row['level_id'];

			flash('message', 'Pengguna berhasil didaftarkan! Anda telah login!');
			redirect();

		} else {
			die('Terjadi kesalahan: ' . mysqli_error($conn));
		}

	}

}