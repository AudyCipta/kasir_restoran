<?php
if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

$level_result = mysqli_query($conn, "SELECT * FROM level");

$nama 	  = $nama_err 	  = "";
$email 	  = $email_err 	  = "";
$password = $password_err = "";
$level_id = $level_id_err = "";
$foto 	  = $foto_err 	  = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$nama 	  = escape($_POST['nama']);
	$email 	  = escape($_POST['email']);
	$password = escape($_POST['password']);
	$level_id = escape($_POST['level_id']);

	if (empty($nama)) {
		$nama_err = "Nama wajib diisi!";
	} elseif (!preg_match("/^[a-zA-Z-' ]*$/", $nama)) {
		$nama_err = "Nama hanya boleh mengandung huruf dan spasi!";
	}

	$cek_pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE email = '$email'");
	if (empty($email)) {
		$email_err = "Email wajib diisi!";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$email_err = "Format email salah!";
	} elseif (mysqli_num_rows($cek_pengguna) > 0) {
		$email_err = "Email: $email sudah digunakan!";
	}

	if (empty($password)) {
		$password_err = "Password wajib diisi!";
	} elseif (!preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password || strlen($password) < 6)) {
		$password_err = "Password minimal 6 karakter dan mengandung huruf besar dan angka";
	}

	if (empty($level_id)) {
		$level_id_err = "Level wajib diisi!";
	}

	if (empty($_FILES['foto']['name'])) {
		$foto = 'default.svg';
	} else {
		$foto = random_str() . '_' . $_FILES['foto']['name'];

		if ($_FILES['foto']['size'] > 2048000) {
			$foto_err = "File yang diupload tidak boleh lebih dari 2MB!";
		}

		$ext = ['jpg', 'png', 'jpeg', 'svg'];
		$foto_ext = explode('.', $foto);
		$foto_ext = strtolower(end($foto_ext));

		if (!in_array($foto_ext, $ext)) {
			$foto_err = "Format file yang dapat upload ( jpg / png / jpeg / svg )";
		}

		if (empty($nama_err) && empty($email_err) && empty($password_err) && empty($level_id_err) && empty($foto_err)) {
			move_uploaded_file($_FILES['foto']['tmp_name'], ROOT_PATH . 'uploads/' . $foto);
		}
	}

	if (empty($nama_err) && empty($email_err) && empty($password_err) && empty($level_id_err) && empty($foto_err)) {
		
		$password = password_hash($password, PASSWORD_DEFAULT);
		$query = "INSERT INTO pengguna (nama, email, password, level_id, foto) VALUES ('$nama', '$email', '$password', '$level_id', '$foto')";

		if (mysqli_query($conn, $query)) {

			flash('message', 'Data pengguna berhasil ditambahkan!');
			redirect('admin/pengguna.php');

		} else {
			die('Terjadi kesalahan: ' . mysqli_error($conn));
		}

	}

}