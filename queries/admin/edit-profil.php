<?php
if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

$pengguna_id = $_SESSION['pengguna_id'];
$result = mysqli_query($conn, "SELECT pengguna.*, level.nama as nama_level FROM pengguna JOIN level ON pengguna.level_id = level.id WHERE pengguna.id = $pengguna_id");
$row = mysqli_fetch_assoc($result);

$nama 	= $nama_err 	= "";
$email 	= $email_err 	= "";
$foto 	= $foto_err 	= "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$id 	   = escape($_POST['id']);
	$nama 	   = escape($_POST['nama']);
	$email 	   = escape($_POST['email']);
	$foto_lama = escape($_POST['foto_lama']);

	if (empty($nama)) {
		$nama_err = "Nama wajib diisi!";
	} elseif (!preg_match("/^[a-zA-Z-' ]*$/", $nama)) {
		$nama_err = "Nama hanya boleh mengandung huruf dan spasi!";
	}

	$cek_pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE email = '$email' AND id <> $id");
	if (empty($email)) {
		$email_err = "Email wajib diisi!";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$email_err = "Format email salah!";
	} elseif (mysqli_num_rows($cek_pengguna) > 0) {
		$email_err = "Email: $email sudah digunakan!";
	}

	if (empty($_FILES['foto']['name'])) {
		$foto = $foto_lama;
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

		if (empty($nama_err) && empty($email_err) && empty($foto_err)) {

			if ($foto_lama != 'default.svg') {
				$file = ROOT_PATH . 'uploads/' . $foto_lama;
				unlink($file);
			}
			move_uploaded_file($_FILES['foto']['tmp_name'], ROOT_PATH . '/uploads/' . $foto);

		} else {
			$foto = $foto_lama;
		}
	}

	if (empty($nama_err) && empty($email_err) && empty($foto_err)) {
		
		$query = "UPDATE pengguna SET nama = '$nama', email = '$email', foto = '$foto' WHERE id = $id";

		if (mysqli_query($conn, $query)) {

			$_SESSION['pengguna_id'] = $id;
			$_SESSION['pengguna_nama'] = $nama;
			$_SESSION['pengguna_foto'] = $foto;

			flash('message', 'Profil berhasil diupdate!');
			redirect('admin/edit-profil.php');

		} else {
			die('Terjadi kesalahan: ' . mysqli_error($conn));
		}

	}

}