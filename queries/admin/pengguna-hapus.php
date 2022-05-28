<?php
require '../../core.php';

if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$id = escape($_POST['id']);

	if ($id == $_SESSION['pengguna_id']) {
		flash('message', 'Pengguna sedang aktif! tidak dapat menghapus!', 'warning');
		redirect('admin/pengguna.php');
	}

	$result = mysqli_query($conn, "SELECT * FROM pengguna WHERE id = $id");
	$row = mysqli_fetch_assoc($result);
	if ($row['foto'] != 'default.svg') {
		$file = ROOT_PATH . 'uploads/' . $row['foto'];
		unlink($file);
	}

	if (mysqli_query($conn, "DELETE FROM pengguna WHERE id = $id")) {
		flash('message', 'Data pengguna berhasil dihapus');
	} else {
		die('Terjadi kesalahan: ' . mysqli_error($conn));
	}

}

redirect('admin/pengguna.php');