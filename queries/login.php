<?php
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	$id  = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	$result = mysqli_query($conn, "SELECT nama FROM pengguna WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	if ($key === hash('sha256', $row['nama'])) {
		$_SESSION['pengguna_id'] 	= $row['id'];
		$_SESSION['pengguna_nama'] 	= $row['nama'];
		$_SESSION['pengguna_foto'] 	= $row['foto'];
		$_SESSION['pengguna_level'] = $row['level_id'];
	}
}

if (isset($_SESSION['pengguna_id'])) {
	if ($_SESSION['pengguna_level'] != 3) {
		redirect('admin');
	} else {
		redirect();
	}
}

$email 	  = $email_err 	  = "";
$password = $password_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$email 	  = escape($_POST['email']);
	$password = escape($_POST['password']);

	if (empty($email)) {
		$email_err = "Email wajib diisi!";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$email_err = "Email format salah!";
	}

	if (empty($password)) {
		$password_err = "Password wajib diisi!";
	}

	if (empty($email_err) && empty($password_err)) {
		
		$result = mysqli_query($conn, "SELECT * FROM pengguna WHERE email = '$email'");

		if (mysqli_num_rows($result) == 1) {

			$row = mysqli_fetch_assoc($result);
			if (password_verify($password, $row['password'])) {
				
				$_SESSION['pengguna_id'] 	= $row['id'];
				$_SESSION['pengguna_nama'] 	= $row['nama'];
				$_SESSION['pengguna_foto'] 	= $row['foto'];
				$_SESSION['pengguna_level'] = $row['level_id'];

				if (isset($_POST['remember'])) {
					setcookie('id', $row['id'], time() + (60 * 60 * 24 * 15));
					setcookie('key', hash('sha256', $row['nama']), time()+(60 * 60 * 24 * 15));
				}

				flash('message', 'Login berhasil!');
				if ($row['level_id'] != 3) {
					redirect('admin');
				} else {
					redirect();
				}

			} else {
				$password_err = "Password salah!";
			}

		} else {
			$email_err = "Email belum terdaftar!";
		}

	}

}